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
 * Defines common functionality for interacting with validation results
 *
 * @package Fuel\Validation
 * @author  Fuel Development Team
 *
 * @since   2.0
 */
class Result implements ResultInterface
{

	/**
	 * Boolean flag to indicate overall failure or success
	 *
	 * @var bool
	 */
	protected $result;

	/**
	 * Contains an array of errors that occurred during validation
	 *
	 * @var string[]
	 */
	protected $errors = array();

	/**
	 * Contains the rule that caused a given field to fail
	 *
	 * @var RuleInterface[]
	 */
	protected $failedRules = array();

	/**
	 * Contains a list of fields that passed validation
	 *
	 * @var string[]
	 */
	protected $validated = array();

	/**
	 * @param bool $isValid
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function setResult($isValid)
	{
		$this->result = $isValid;

		return $this;
	}

	/**
	 * @return bool
	 *
	 * @since 2.0
	 */
	public function isValid()
	{
		return $this->result;
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 * @throws InvalidFieldException
	 *
	 * @since 2.0
	 */
	public function getError($field)
	{
		if ( ! isset($this->errors[$field]))
		{
			throw new InvalidFieldException($field);
		}

		return $this->errors[$field];
	}

	/**
	 * @return string[]
	 *
	 * @since 2.0
	 */
	public function getErrors()
	{
		return $this->errors;
	}

	/**
	 * Sets the error message for the given field
	 *
	 * @param string $field
	 * @param string $message
	 * @param string $rule
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function setError($field, $message, $rule)
	{
		$this->errors[$field] = $message;
		$this->failedRules[$field] = $rule;

		return $this;
	}

	/**
	 * @return string[]
	 *
	 * @since 2.0
	 */
	public function getValidated()
	{
		return $this->validated;
	}

	/**
	 * @param string $field
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function setValidated($field)
	{
		$this->validated[] = $field;

		return $this;
	}

	/**
	 * Returns a list of rules that caused fields to fail, indexed by the field name.
	 *
	 * @return RuleInterface[]
	 *
	 * @since 2.0
	 */
	public function getFailedRules()
	{
		return $this->failedRules;
	}

}
