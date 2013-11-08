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
 * Checks that the value is longer than the given minimum length.
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @since	2.0
 */
class MinLength extends AbstractRule
{

	/**
	 * Contains the rule failure message
	 *
	 * @var string
	 */
	protected $message = 'The field does not satisfy the minimum length requirement.';

	/**
	 * @param mixed  $value Value to be validated
	 * @param string $field Unused by this rule
	 * @param array  $allFields Unused by this rule
	 *
	 * @return bool
	 *
	 * @since 2.0
	 */
	public function validate($value, $field = null, $allFields = null)
	{

		if ( (is_object($value) and ! method_exists($value, '__toString')) or $this->getParameter() === null )
		{
			return false;
		}

		mb_internal_encoding('UTF-8');

		return (mb_strlen(( string ) $value) >= $this->getParameter());
	}

	/**
	 * Returns
	 *
	 * array(
	 * 		'minLength' => <target length>
	 * );
	 *
	 * @return string[]
	 */
	public function getMessageParameters()
	{
		return array(
			'minLength' => $this->getParameter(),
		);
	}

}
