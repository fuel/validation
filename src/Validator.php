<?php
/**
 * @package   Fuel\Validation
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Validation;

use InvalidArgumentException;
use LogicException;

/**
 * Main entry point for the validation functionality. Handles registering validation rules and loading validation
 * adaptors.
 *
 * @package Fuel\Validation
 * @author  Fuel Development Team
 * @since   2.0
 *
 * @method $this email()
 * @method $this ip()
 * @method $this matchField(string $matchAgainst)
 * @method $this minLength(integer $minLength)
 * @method $this maxLength(integer $maxLength)
 * @method $this number()
 * @method $this numericBetween([integer $min, integer $max])
 * @method $this numericMax(integer $max)
 * @method $this numericMin(integer $min)
 * @method $this regex(string $regex)
 * @method $this required()
 * @method $this url()
 * @method $this date(['format' => string $format])
 * @method $this type(string $type)
 * @method $this enum(array $values)
 * @method $this enumMulti(array $values)
 * @method $this validator(ValidatableInterface $validator)
 */
class Validator implements ValidatableInterface
{

	/**
	 * Contains a list of fields to be validated
	 *
	 * @var FieldInterface[]
	 */
	protected $fields = array();

	/**
	 * Contains a list of any custom validation rules
	 *
	 * @var string[]
	 */
	protected $customRules = array();

	/**
	 * @var string[]
	 */
	protected $messages = array();

	/**
	 * Keeps track of the last field added for magic method chaining
	 *
	 * @var FieldInterface
	 */
	protected $lastAddedField;

	/**
	 * Keeps track of the last rule added for message setting
	 *
	 * @var RuleInterface
	 */
	protected $lastAddedRule;

	/**
	 * Default namespace to look for rules in when a rule is not known
	 *
	 * @var string
	 */
	protected $ruleNamespace = 'Fuel\Validation\Rule\\';

	/**
	 * Adds a rule that can be used to validate a field
	 *
	 * @param string|FieldInterface $field
	 * @param RuleInterface         $rule
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function addRule($field, RuleInterface $rule)
	{
		if (is_string($field))
		{
			try
			{
				$field = $this->getField($field);
			}
			catch (InvalidFieldException $ife)
			{
				// The field does not exist so create it
				$this->addField($field);
				$field = $this->getField($field);
			}
		}

		// We have a valid field now so add the rule
		$field->addRule($rule);

		$this->lastAddedRule = $rule;

		return $this;
	}

	/**
	 * Adds a new field to the validation object
	 *
	 * @param string|FieldInterface $field
	 * @param string                $label Field name to use in messages, set to null to use $field
	 *
	 * @return $this
	 *
	 * @throws InvalidArgumentException
	 *
	 * @since 2.0
	 */
	public function addField($field, $label = null)
	{
		if (is_string($field))
		{
			$field = new Field($field, $label);
		}

		if ( ! $field instanceof FieldInterface)
		{
			throw new InvalidArgumentException('VAL-007: Only FieldInterfaces can be added as a field.');
		}

		$this->fields[$field->getName()] = $field;
		$this->lastAddedField = $field;

		return $this;
	}

	/**
	 * Returns the given field
	 *
	 * @param $name
	 *
	 * @return FieldInterface
	 *
	 * @throws InvalidFieldException
	 *
	 * @since 2.0
	 */
	public function getField($name)
	{
		if ( ! isset($this->fields[$name]))
		{
			throw new InvalidFieldException($name);
		}

		return $this->fields[$name];
	}

	/**
	 * Takes an array of data and validates that against the assigned rules.
	 * The array is expected to have keys named after fields.
	 * This function will call reset() before it runs.
	 *
	 * @param array           $data
	 * @param ResultInterface $result
	 *
	 * @return ResultInterface
	 *
	 * @since 2.0
	 */
	public function run($data, ResultInterface $result = null)
	{
		if ($result === null)
		{
			$result = new Result;
		}

		$result->setResult(true);

		foreach ($this->fields as $fieldName => $rules)
		{
			$fieldResult = $this->validateField($fieldName, $data, $result);

			if ( ! $fieldResult)
			{
				// There was a failure so log it to the result object
				$result->setResult(false);
			}
		}

		return $result;
	}

	/**
	 * Takes a field name and an array of data and validates the field against the assigned rules.
	 * The array is expected to have keys named after fields.
	 * This function will call reset() before it runs.
	 *
	 * @param string          $field
	 * @param array           $data
	 * @param ResultInterface $result
	 *
	 * @return ResultInterface
	 *
	 * @since 2.0
	 */
	public function runField($field, array $data, ResultInterface $result = null)
	{
		if ($result === null)
		{
			$result = new Result;
		}

		$fieldResult = false;

		if (isset($data[$field]))
		{
			$fieldResult = $this->validateField($field, $data, $result);
		}

		// Log the result
		$result->setResult($fieldResult);

		return $result;
	}

	/**
	 * Validates a single field
	 *
	 * @param string          $field
	 * @param mixed[]         $data
	 * @param ResultInterface $result
	 *
	 * @return bool
	 *
	 * @since 2.0
	 */
	protected function validateField($field, $data, ResultInterface $result)
	{
		$value = null;

		// If there is data, and the data is not empty and not numeric. This allows for strings such as '0' to be passed
		// as valid values.
		$dataPresent = isset($data[$field]) && ! (empty($data[$field]) && ! is_numeric($data[$field]));

		if ($dataPresent)
		{
			$value = $data[$field];
		}

		$rules = $this->getFieldRules($field);

		foreach ($rules as $rule)
		{
			if ( ! $dataPresent && ! $rule->canAlwaysRun())
			{
				continue;
			}

			$validateResult = $rule->validate($value, $field, $data);

			if ($validateResult instanceof ResultInterface)
			{
				$result->merge($validateResult, $field . '.');
				return $validateResult->isValid();
			}

			if ( ! $validateResult)
			{
				// Don't allow any others to run if this one failed
				$result->setError($field, $this->buildMessage($this->getField($field), $rule, $value), $rule);

				return false;
			}
		}

		// All is good so make sure the field gets added as one of the validated fields
		$result->setValidated($field);

		return true;
	}

	/**
	 * Gets a Rule's message and processes that with various tokens
	 *
	 * @param FieldInterface $field
	 * @param RuleInterface  $rule
	 *
	 * @return string
	 */
	protected function buildMessage(FieldInterface $field, RuleInterface $rule, $value)
	{
		// Build an array with all the token values
		$tokens = array_merge(array(
			'name' => $field->getName(),
			'label' => $field->getLabel(),
			'value' => $value,
		), $rule->getMessageParameters());

		return $this->processMessageTokens($tokens, $rule->getMessage());
	}

	/**
	 * Replaces any {} tokens with the matching value from $tokens.
	 *
	 * @param array $tokens   Associative array of token names and values
	 * @param string $message
	 *
	 * @return string
	 *
	 * @since 2.0
	 */
	protected function processMessageTokens(array $tokens, $message)
	{
		foreach ($tokens as $token => $value)
		{
			$message = str_replace('{' . $token . '}', $value, $message);
		}

		return $message;
	}

	/**
	 * @param string $fieldName
	 *
	 * @return RuleInterface[]
	 */
	public function getFieldRules($fieldName)
	{
		try
		{
			$field = $this->getField($fieldName);
		}
		catch (InvalidFieldException $ife)
		{
			// No field found so no rules
			return array();
		}

		return $field->getRules();
	}

	/**
	 * Allows validation rules to be dynamically added using method chaining.
	 *
	 * @param string $name
	 * @param array  $arguments
	 *
	 * @return $this
	 * @throws InvalidRuleException
	 *
	 * @since 2.0
	 */
	public function __call($name, $arguments)
	{
		// Create and then add the new rule to the last added field
		$rule = $this->createRuleInstance($name, $arguments);

		$this->addRule($this->lastAddedField, $rule);

		return $this;
	}

	/**
	 * Sets the failure message for the last added rule
	 *
	 * @param string $message
	 *
	 * @return $this
	 *
	 * @throws LogicException
	 *
	 * @since 2.0
	 */
	public function setMessage($message)
	{
		if ( ! $this->lastAddedRule)
		{
			throw new LogicException('VAL-006: A rule should be added before setting a message.');
		}

		$this->lastAddedRule->setMessage($message);

		return $this;
	}

	/**
	 * Creates an instance of the given rule name
	 *
	 * @param string $name
	 * @param mixed  $parameters
	 *
	 * @return RuleInterface
	 *
	 * @throws InvalidRuleException
	 *
	 * @since 2.0
	 */
	public function createRuleInstance($name, $parameters = [])
	{
		$className = $this->getRuleClassName($name);

		if ( ! class_exists($className))
		{
			throw new InvalidRuleException($name);
		}

		/* @var RuleInterface $instance */
		$reflection = new \ReflectionClass($className);
		$instance = $reflection->newInstanceArgs($parameters);

		// Check if there is a custom message
		$message = $this->getGlobalMessage($name);

		if ($message !== null)
		{
			$instance->setMessage($message);
		}

		return $instance;
	}

	/**
	 * Returns the full class name for the given validation rule
	 *
	 * @param string $name
	 *
	 * @return string
	 *
	 * @since 2.0
	 */
	protected function getRuleClassName($name)
	{
		// Check if we have a custom rule registered
		if (isset($this->customRules[$name]))
		{
			// We do so grab the class name from the store
			return $this->customRules[$name];
		}

		return $this->ruleNamespace . ucfirst($name);
	}

	/**
	 * Adds custom validation rules and allows for core rules to be overridden.
	 * When wanting to override a core rule just specify the rule name as $name.
	 * Eg, 'required', 'minLength'. Note the lowercase first letter.
	 *
	 * The name of the rule should not contain any whitespace or special characters as the name will be available
	 * to use as a function name in the method chaining syntax.
	 *
	 * @param string $name
	 * @param string $class
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function addCustomRule($name, $class)
	{
		$this->customRules[$name] = $class;

		return $this;
	}

	/**
	 * Sets a custom message for all fields of the given type that are created after the message has been set.
	 *
	 * @param string      $ruleName Name of the rule to set a message for, eg, required, number, exactLength
	 * @param string|null $message  Set to null to disable the custom message
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function setGlobalMessage($ruleName, $message)
	{
		$this->messages[$ruleName] = $message;

		if ($message === null)
		{
			$this->removeGlobalMessage($ruleName);
		}

		return $this;
	}

	/**
	 * Sets custom messages for one or more rules. Setting the value to "null" will remove the message
	 *
	 * @param string[] $messages
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function setGlobalMessages($messages)
	{
		foreach ($messages as $name => $value)
		{
			$this->setGlobalMessage($name, $value);
		}

		return $this;
	}

	/**
	 * Removes a global rule message
	 *
	 * @param string $ruleName
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function removeGlobalMessage($ruleName)
	{
		unset($this->messages[$ruleName]);

		return $this;
	}

	/**
	 * Gets the global message set for a rule
	 *
	 * @param string $ruleName
	 *
	 * @return null|string Will be null if there is no message
	 */
	public function getGlobalMessage($ruleName)
	{
		if ( ! isset($this->messages[$ruleName]))
		{
			return null;
		}

		return $this->messages[$ruleName];
	}

}
