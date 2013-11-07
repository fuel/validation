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
 * Checks that the value is greater than or equal to a value
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 * @since   2.0
 */
class NumericMin extends AbstractRule
{

	/**
	 * @param mixed  $params
	 * @param string $message
	 *
	 * @since 2.0
	 */
	public function __construct($params = null, $message = '')
	{
		parent::__construct($params, $message);

		if ($message == '')
		{
			$this->setMessage('The field is not equal to or greater than the specified value.');
		}
	}

	/**
	 * @param mixed  $value     Value to validate
	 * @param string $field     Unused by this rule
	 * @param array  $allFields Unused by this rule
	 *
	 * @return bool
	 *
	 * @since 2.0
	 */
	public function validate($value, $field = null, &$allFields = null)
	{
		$min = $this->getParameter();

		if ($min === null or ! is_numeric($value))
		{
			return false;
		}

		return $value >= $min;
	}
}
