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

/**
 * Defines a common interface for validation results
 *
 * @package Fuel\Validation
 * @author  Fuel Development Team
 */
interface ResultInterface
{

	/**
	 * Sets a true false flag for if the validation result is successful or not.
	 *
	 * @param bool $isValid
	 *
	 * @return $this
	 */
	public function setResult($isValid);

	/**
	 * True if the validation passed
	 *
	 * @return bool
	 */
	public function isValid();

	/**
	 * Gets an error message for the given field. Will return null if there is no message.
	 *
	 * @param string $field
	 *
	 * @return string
	 */
	public function getError($field);

	/**
	 * Returns a list of all validation errors.
	 *
	 * @return string[]
	 */
	public function getErrors();

	/**
	 * Sets the message for a given field.
	 *
	 * @param string $field
	 * @param string $message
	 *
	 * @return $this
	 */
	public function setError($field, $message);

	/**
	 * Returns a list of fields that where successfully validated.
	 *
	 * @return string[]
	 */
	public function getValidated();

	/**
	 * Sets the name of a field that has passed validation
	 *
	 * @param string[] $fields
	 *
	 * @return $this
	 */
	public function setValidated($field);

}
