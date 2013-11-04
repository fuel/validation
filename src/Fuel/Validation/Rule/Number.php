<?php

/**
 * Part of the FuelPHP framework.
 *
 * @package   Fuel\Validation
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */

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

	public function __construct($params = null, $message = '')
	{
		parent::__construct($params, $message);

		if ($message == '')
		{
			$this->setMessage('The field is not valid number.');
		}
	}

	/**
	 * Performs validation on the given value
	 *
	 * @param mixed $value Value to validate
	 *
	 * @return bool
	 */
	public function validate($value, $field = null, &$allFields = null)
	{
		return is_numeric($value);
	}
}
