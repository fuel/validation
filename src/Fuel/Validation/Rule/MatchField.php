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
 * Validates that the value of the given field matches the value of another field in the data set.
 *
 * The parameter of this rule should be the name of the field to match against.
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @since   2.0
 */
class MatchField extends AbstractRule
{
	/**
	 * Contains the rule failure message
	 *
	 * @var string
	 */
	protected $message = 'The field does not match the other given field.';

	/**
	 * Returns true if $value matches the value of the field specified with setParameter()
	 *
	 * @param mixed  $value Value to validate
	 * @param string $field Name of the field that is being validated
	 * @param array  $allFields Values of all the other fields being validated
	 *
	 * @return bool
	 *
	 * @since 2.0
	 */
	public function validate($value, $field = null, $allFields = null)
	{
		$matchAgainst = $this->getParameter();

		// If any of the needed settings are missing, return false and
		// check if the array key exists, if not nothing to validate against
		if ($allFields === null or $matchAgainst === null or ! isset($allFields[$matchAgainst]))
		{
			return false;
		}

		return $allFields[$matchAgainst] == $value;
	}

}
