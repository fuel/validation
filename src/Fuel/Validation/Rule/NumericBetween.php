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
 * Checks that a numerical value is between the two given parameters.
 *
 * setParameters() should be called with an array where the first value is the lower bound and the second value is the
 * upper bound.
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @since 2.0
 */
class NumericBetween extends AbstractRule
{
	/**
	 * Contains the rule failure message
	 *
	 * @var string
	 */
	protected $message = 'The field is not between the specified values.';

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
		$params = $this->getParameter();

		if ( ! $this->paramsValid($params) or ! is_numeric($value))
		{
			return false;
		}

		// We know the params are valid at this point so pull them out
		list($lower, $upper) = $params;

		return ($value > $lower and $value < $upper);
	}

	/**
	 * Returns true if the given params are not null, an array and has at least two values
	 *
	 * @param $params
	 *
	 * @return bool
	 *
	 * @since 2.0
	 */
	protected function paramsValid($params)
	{
		if ($params === null or ! is_array($params) or count($params) < 2)
		{
			return false;
		}

		return true;
	}
}
