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

	public function __construct($params = null, $message = '')
	{
		parent::__construct($params, $message);

		if ($message == '')
		{
			$this->setMessage('The length of the field is not exactly equal to the length specified.');
		}
	}

	/**
	 * @param mixed $value
	 * @param string    $field
	 * @param array $allFields
	 *
	 * @return bool
	 *
	 * @since 2.0
	 */
	public function validate($value, $field = null, &$allFields = null)
	{
		mb_internal_encoding('UTF-8');
		if ( is_object($value) && ! method_exists($value, '__toString'))
		{
			if($this->getParameter() === null)
			{
				return true;
			}
			return false;
		}
		return (mb_strlen(( string ) $value) == $this->getParameter());
	}

}
