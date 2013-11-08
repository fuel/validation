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
 * Checks that the length of a string is exactly equal to a value specified.
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @since 2.0
 */
class ExactLength extends AbstractRule
{

	/**
	 * Default failure message
	 *
	 * @var string
	 */
	protected $message = 'The length of the field is not exactly equal to the length specified.';

	/**
	 * @param mixed  $value
	 * @param string $field
	 * @param array  $allFields
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

		return (mb_strlen(( string ) $value) == $this->getParameter());
	}

	/**
	 * Returns
	 *
	 * array(
	 * 		'length' => <target length>
	 * );
	 *
	 * @return string[]
	 */
	public function getMessageParameters()
	{
		return array(
			'length' => $this->getParameter(),
		);
	}

}
