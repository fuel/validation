<?php
/**
 * @package   Fuel\Validation
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 * @link      http://fuelphp.com
 */

/**
 * Dummy AbstractRule child for testing
 *
 * @package Fuel\Validation
 * @author  Fuel Development Team
 *
 * @codeCoverageIgnore
 */
class DummyAbstractRule extends \Fuel\Validation\AbstractRule
{

	/**
	 * Does a simple check to see if $value == true
	 *
	 * @param mixed $value
	 * @param null  $field
	 * @param null  $allFields
	 *
	 * @return bool
	 */
	public function validate($value, $field = null, &$allFields = null)
	{
		return ($value == true);
	}

}
