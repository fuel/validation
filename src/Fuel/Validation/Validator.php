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

/**
 * Main entry point for the validation functionality. Handles registering validation rules and loading validation
 * adaptors.
 *
 * @package Fuel\Validation
 * @author  Fuel Development Team
 * @since   2.0
 */
class Validator
{

	/**
	 * Contains a list of fields and all their rules
	 *
	 * @var RuleInterface[][]
	 */
	protected $rules = array();

	/**
	 * Contains a list of any custom validation rules
	 *
	 * @var string[]
	 */
	protected $customRules = array();

	/**
	 * Keeps track of the last field added for magic method chaining
	 *
	 * @var string
	 */
	protected $lastAddedField;

	/**
	 * Adds a rule that can be used to validate a field
	 *
	 * @param string        $field
	 * @param RuleInterface $rule
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function addRule($field, RuleInterface $rule)
	{
		if ( ! array_key_exists($field, $this->rules))
		{
			$this->addField($field);
		}

		$this->rules[$field][] = $rule;

		return $this;
	}

	/**
	 * Adds a new field to the validation object
	 *
	 * @param string $field
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function addField($field)
	{
		$this->rules[$field] = array();
		$this->lastAddedField = $field;

		return $this;
	}

	/**
	 * Returns a list of all known validation rules for a given field.
	 *
	 * @param string $field Name of the field to get rules for, or null for all fields
	 *
	 * @throws InvalidFieldException
	 *
	 * @return RuleInterface[]|RuleInterface[][]
	 *
	 * @since 2.0
	 */
	public function getRules($field = null)
	{
		// Check if we are fetching a specific field or all
		if ($field === null)
		{
			return $this->rules;
		}

		// Now we know we have a field check that we know about it
		if ( ! array_key_exists($field, $this->rules))
		{
			// If it's not there, throw an exception
			throw new InvalidFieldException($field);
		}

		// Return the requested field
		return $this->rules[$field];
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
	public function run(array $data, ResultInterface $result = null)
	{
		if ($result === null)
		{
			$result = new Result;
		}

		$result->setResult(true);

		foreach ($data as $fieldName => $value)
		{
			$fieldResult = $this->validateField($fieldName, $value, $data, $result);

			if ( ! $fieldResult)
			{
				// There was a failure so log it to the result object
				$result->setResult(false);
			}
		}

		return $result;
	}

	/**
	 * Validates a single field
	 *
	 * @param string          $field
	 * @param mixed           $value
	 * @param mixed[]       & $data
	 * @param ResultInterface $resultInterface
	 *
	 * @return bool
	 *
	 * @since 2.0
	 */
	protected function validateField($field, $value, &$data, ResultInterface $resultInterface)
	{
		$rules = $this->getRules($field);

		foreach ($rules as $rule)
		{
			if ( ! $rule->validate($value, $field, $data))
			{
				// Don't allow any others to run if this one failed
				$resultInterface->setError($field, $rule->getMessage());

				return false;
			}
		}

		// All is good so make sure the field gets added as one of the validated fields
		$resultInterface->setValidated($field);

		return true;
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
	public function createRuleInstance($name, $parameters = null)
	{
		$className = $this->getRuleClassName($name);

		if ( ! class_exists($className))
		{
			throw new InvalidRuleException($name);
		}

		return new $className($parameters);
	}

	/**
	 * Returns the full class name for the given validation rule
	 *
	 * @param $name
	 *
	 * @return string
	 *
	 * @since 2.0
	 */
	protected function getRuleClassName($name)
	{
		// Check if we have a custom rule registered
		if (array_key_exists($name, $this->customRules))
		{
			// We do so grab the class name from the store
			return $this->customRules[$name];
		}

		return 'Fuel\Validation\Rule\\' . ucfirst($name);
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

}
