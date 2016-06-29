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
 * Checks if a value is one of given values
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @since   2.0
 */
class Enum extends AbstractRule
{

	/**
	 * Contains the rule failure message
	 *
	 * @var string
	 */
	protected $message = 'The field is not one of the given value(s).';

	/**
	 * Strict check mode
	 *
	 * @var bool
	 */
	protected $strict = false;

	/**
	 * Performs validation on the given value
	 *
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
		$values = $this->getParameter();

		return in_array($value, $values, $this->strict);
	}

	/**
	 * Sets the value(s) and mode to check against
	 *
	 * @param string $params
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function setParameter($params)
	{
		if (is_array($params) === false)
		{
			$params = (array) $params;
		}
		elseif (array_key_exists('strict', $params) and array_key_exists('values', $params))
		{
			$this->strict = (bool) $params['strict'];
			$params = $params['values'];
		}

		return parent::setParameter($params);
	}

	/**
	 * Check strict mode
	 *
	 * @return bool
	 *
	 * @since 2.0
	 */
	public function isStrict()
	{
		return $this->strict;
	}

	/**
	 * Set strict mode
	 *
	 * @param bool $strict
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function setStrict($strict)
	{
		$this->strict = (bool) $strict;

		return $this;
	}

}
