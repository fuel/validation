<?php
/**
 * @package   Fuel\Validation
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Validation\RuleProvider;

use ArrayAccess;
use Fuel\Validation\ValidationAwareInterface;
use Fuel\Validation\Validator;
use InvalidArgumentException;

/**
 * Allows sets of validation rules to be generated from an array structure
 *
 * @package Fuel\Validation\RuleProvider
 * @author  Fuel Development Team
 * @since   2.0
 */
class FromArray implements ValidationAwareInterface
{

	/**
	 * @var array
	 */
	protected $data;

	/**
	 * The key of label
	 *
	 * @var string
	 */
	protected $labelKey = 'label';

	/**
	 * The key of rules
	 *
	 * @var string
	 */
	protected $ruleKey = 'rules';

	public function __construct($labelKey = null, $ruleKey = 'rules')
	{
		if ($labelKey !== true)
		{
			$this->labelKey = $labelKey;
		}

		$this->ruleKey = $ruleKey;
	}

	/**
	 * Sets the array that will be used to generate
	 *
	 * @param array $data
	 *
	 * @return $this
	 *
	 * @throws InvalidArgumentException
	 *
	 * @since 2.0
	 */
	public function setData($data)
	{
		if ( ! is_array($data) && ! $data instanceof ArrayAccess)
		{
			throw new InvalidArgumentException('VAL-008: $data must be an array or implement the ArrayAccess interface.');
		}

		$this->data = $data;

		return $this;
	}

	/**
	 * @return array
	 *
	 * @since 2.0
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * Should populate the given validator with the needed rules.
	 *
	 * @param Validator $validator
	 *
	 * @return Validator
	 *
	 * @throws InvalidArgumentException
	 *
	 * @since 2.0
	 */
	public function populateValidator(Validator $validator)
	{
		$data = $this->getData();

		if ($data === null)
		{
			throw new InvalidArgumentException('VAL-005: No data specified. Please call setData() first.');
		}

		// Loop through and add all the rules
		foreach ($data as $field => $rules)
		{
			$this->addFieldRules($field, $rules, $validator);
		}

		return $validator;
	}

	/**
	 * Processes the given field and rules to add them to the validator.
	 *
	 * @param string    $field Name of the field to add rules to
	 * @param array     $rules Array of any rules to be added to the field
	 * @param Validator $validator Validator object to apply rules to
	 *
	 * @since 2.0
	 */
	protected function addFieldRules($field, $rules, Validator $validator)
	{
		$label = null;

		if ( ! empty($this->labelKey))
		{
			if (array_key_exists($this->labelKey, $rules))
			{
				$label = $rules[$this->labelKey];
			}

			if (array_key_exists($this->ruleKey, $rules))
			{
				$rules = $rules[$this->ruleKey];
			}
			else
			{
				$rules = array();
			}
		}

		$validator->addField($field, $label);

		// Add each of the rules
		foreach ($rules as $ruleName => $params)
		{
			$this->addFieldRule($field, $ruleName, $params, $validator);
		}
	}

	/**
	 * Adds an individual rule for the given field to the given validator.
	 * If the $ruleName is numeric the function will assume that $params is the rule name and that there are no
	 * parameters.
	 *
	 * @param string     $fieldName
	 * @param string|int $ruleName
	 * @param mixed      $params
	 * @param Validator  $validator
	 *
	 * @since 2.0
	 */
	protected function addFieldRule($fieldName, $ruleName, $params, Validator $validator)
	{
		// If $ruleName is numeric assume that $params is the name and there are no actual parameters
		if (is_numeric($ruleName))
		{
			$ruleName = $params;
			$params = [];
		}

		// Create and add the rule
		$ruleInstance = $validator->createRuleInstance($ruleName, $params);
		$validator->addRule($fieldName, $ruleInstance);
	}

}
