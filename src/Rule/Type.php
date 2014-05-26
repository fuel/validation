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
 * Checks if a value is a typeof or instanceof parameter
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @since   2.0
 */
class Type extends AbstractRule
{

	/**
	 * Contains the rule failure message
	 *
	 * @var string
	 */
	protected $message = 'The field is not one of the given type(s).';

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
		$allowedTypes = (array) $this->getParameter();

		foreach ($allowedTypes as $type)
		{
			$isFunction = 'is_'.$type;

			if (function_exists($isFunction) and $isFunction($value))
			{
				return true;
			}
			elseif ($value instanceof $type)
			{
				return true;
			}
		}

		return false;
	}

}
