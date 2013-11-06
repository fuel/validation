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
 * Defines a common interface for validation results
 *
 * @package Fuel\Validation
 * @author  Fuel Development Team
 *
 * @since   2.0
 */
interface ResultInterface
{

	/**
	 * Sets a true false flag for if the validation result is successful or not.
	 *
	 * @param bool $isValid
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function setResult($isValid);

	/**
	 * True if the validation passed
	 *
	 * @return bool
	 *
	 * @since 2.0
	 */
	public function isValid();

	/**
	 * Gets an error message for the given field. Will return null if there is no message.
	 *
	 * @param string $field
	 *
	 * @return string
	 *
	 * @since 2.0
	 */
	public function getError($field);

	/**
	 * Returns a list of all validation errors.
	 *
	 * @return string[]
	 *
	 * @since 2.0
	 */
	public function getErrors();

	/**
	 * Sets the message for a given field.
	 *
	 * @param string $field
	 * @param string $message
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function setError($field, $message);

	/**
	 * Returns a list of fields that where successfully validated.
	 *
	 * @return string[]
	 *
	 * @since 2.0
	 */
	public function getValidated();

	/**
	 * Sets the name of a field that has passed validation
	 *
	 * @param string[] $fields
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function setValidated($field);

}
