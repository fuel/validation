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
 * Checks that the given field exists
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 */
class Required extends AbstractRule
{

	public function __construct($params = null, $message = '')
	{
		parent::__construct($params, $message);

		if ($message == '')
		{
			$this->setMessage('The field is required and has not been specified.');
		}
	}

	/**
	 * @param mixed $value
	 * @param null  $field
	 * @param null  $allFields
	 *
	 * @return bool
	 */
	public function validate($value, $field = null, &$allFields = null)
	{
		// Make sure the array key exists in the data
		// This check will only be performed if $field and $allFields are set. Else only the value passed will be tested
		if ( ( ! is_null($field) and ! is_null($allFields) ) and
			! array_key_exists($field, $allFields)
		)
		{
			return false;
		}

		return ! ($value === false or
			$value === null or
			$value === '' or
			$value === array()
		);
	}
}
