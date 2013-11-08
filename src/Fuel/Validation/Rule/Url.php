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
 * Performs validation to check that a value is a valid url or not
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 * @since   2.0
 */
class Url extends AbstractRule
{
	/**
	 * Contains the rule failure message
	 *
	 * @var string
	 */
	protected $message = 'The field is not a valid url.';

	/**
	 * @param mixed  $value Value to validate
	 * @param string $field Unused by this rule
	 * @param array  $allFields Unused by this rule
	 *
	 * @return bool
	 *
	 * @since 2.0
	 */
	public function validate($value, $field = null, $allFields = null)
	{
		return false !== filter_var($value, FILTER_VALIDATE_URL);
	}
}
