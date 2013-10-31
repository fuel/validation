<?php


namespace Fuel\Validation\Rule;


use Fuel\Validation\AbstractRule;

/**
 * Checks if a value is a valid number
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 */
class Number extends AbstractRule
{

	public function __construct()
	{
		$this->setMessage('The field is not valid number.');
	}

	/**
	 * Performs validation on the given value
	 *
	 * @param mixed $value Value to validate
	 *
	 * @return bool
	 */
	public function validate($value)
	{
		return is_numeric($value);
	}
}
