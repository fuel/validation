<?php

/**
 * Part of the FuelPHP framework.
 *
 * @package   Fuel\Validation
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */

namespace Fuel\Validation;

use Fuel\Validation\Exception\InvalidField;

/**
 * Defines common functionality for interacting with validation results
 *
 * @package Fuel\Validation
 * @author  Fuel Development Team
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
	 * Contains a list of fields that passed validation
	 *
	 * @var string[]
	 */
	protected $validated = array();

	/**
	 * @param bool $isValid
	 *
	 * @return $this
	 */
	public function setResult($isValid)
	{
		$this->result = $isValid;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isValid()
	{
		return $this->result;
	}

	/**
	 * @param string $field
	 *
	 * @return null|string
	 * @throws InvalidField
	 */
	public function getError($field)
	{
		if ( ! array_key_exists($field, $this->errors))
		{
			throw new InvalidField($field);
		}

		return $this->errors[$field];
	}

	/**
	 * @return string[]
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
	 *
	 * @return $this
	 */
	public function setError($field, $message)
	{
		$this->errors[$field] = $message;

		return $this;
	}

	/**
	 * @return string[]
	 */
	public function getValidated()
	{
		return $this->validated;
	}

	/**
	 * @param string $field
	 *
	 * @return $this
	 */
	public function setValidated($field)
	{
		$this->validated[] = $field;

		return $this;
	}
}
