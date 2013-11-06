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
 */
class MinLength extends AbstractRule
{

	public function __construct($params = null, $message = '')
	{
		parent::__construct($params, $message);

		if ($message == '')
		{
			$this->setMessage('The field does not satisfy the minimum length requirement.');
		}
	}

	/**
	 * @param mixed $value
	 * @param string    $field
	 * @param array $allFields
	 *
	 * @return bool
	 */
	public function validate($value, $field = null, &$allFields = null)
	{
		if ( is_object($value) && ! method_exists($value, '__toString') )
		{
			return false;
		}
		return (strlen(( string ) $value) >= $this->getParameter());
	}

}
