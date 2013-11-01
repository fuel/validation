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
 * Class Email
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 */
class Email extends AbstractRule
{

	public function __construct($params = null, $message = '')
	{
		parent::__construct($params, $message);

		if ($message == '')
		{
			$this->setMessage('The field does not contain a valid email address.');
		}
	}

	/**
	 * Returns true if the given value is a valid email
	 *
	 * @param mixed  $value
	 *
	 * @return bool
	 */
	public function validate($value)
	{
		return false !== filter_var($value, FILTER_VALIDATE_EMAIL);
	}
}
