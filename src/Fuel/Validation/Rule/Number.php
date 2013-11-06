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
 * Checks if a value is a valid number
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @since   2.0
 */
class Number extends AbstractRule
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
			$this->setMessage('The field is not valid number.');
		}
	}

	/**
	 * Performs validation on the given value
	 *
	 * @param mixed $value Value to validate
	 *
	 * @return bool
	 *
	 * @since 2.0
	 */
	public function validate($value, $field = null, &$allFields = null)
	{
		return is_numeric($value);
	}
}
