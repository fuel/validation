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
 * Checks that the value is less than or equal to a value
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 * @since   2.0
 */
class NumericMax extends AbstractRule
{

	/**
	 * Contains the rule failure message
	 *
	 * @var string
	 */
	protected $message = 'The field is not equal to or less than the specified value.';

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
		$max = $this->getParameter();

		if ($max === null or ! is_numeric($value))
		{
			return false;
		}

		return $value <= $max;
	}

	/**
	 * Sets the value to check against
	 *
	 * @param string $params If an array the first value will be used
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function setParameter($params)
	{
		// Ensure we have only a single thing to match against
		if (is_array($params))
		{
			$params = array_shift($params);
		}

		return parent::setParameter($params);
	}

	/**
	 * Returns
	 *
	 * array(
	 * 		'maxValue' => <target value>
	 * );
	 *
	 * @return string[]
	 */
	public function getMessageParameters()
	{
		return array(
			'maxValue' => $this->getParameter(),
		);
	}

}
