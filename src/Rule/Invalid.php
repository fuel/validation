<?php
/**
 * @package   Fuel\Validation
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Validation\Rule;

use Fuel\Validation\AbstractRule;

/**
 * Checks that the given field DOES NOT exist
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @since   2.0
 */
class Invalid extends AbstractRule
{

	/**
	 * Contains the rule failure message
	 *
	 * @var string
	 */
	protected $message = 'The field is invalid and has been specified.';

	protected $alwaysRun = true;

	/**
	 * @param mixed $value
	 * @param null  $field
	 * @param null  $allFields
	 *
	 * @return bool
	 *
	 * @since 2.0
	 */
	public function validate($value, $field = null, $allFields = null)
	{
		// Make sure the array key does not exist in the data
		// This check will only be performed if $field and $allFields are set. Else only the value passed will be tested
		if ($field !== null and $allFields !== null)
		{
			return isset($allFields[$field]) === false;
		}

		return ($value !== 0 and $value !== false and empty($value));
	}

}
