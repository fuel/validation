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
 * Checks that the value is a valid email address
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @since 2.0
 */
class Email extends AbstractRule
{

	/**
	 * Contains the rule failure message
	 *
	 * @var string
	 */
	protected $message = 'The field does not contain a valid email address.';

	/**
	 * @param mixed $value Value to be validated
	 * @param null  $field Unused by this rule
	 * @param null  $allFields
	 *
	 * @internal param null $allFields Unused by this rule
	 *
	 * @return bool
	 *
	 * @since 2.0
	 */
	public function validate($value, $field = null, $allFields = null)
	{
		return false !== filter_var($value, FILTER_VALIDATE_EMAIL);
	}

}
