<?php
/**
 * Part of the FuelPHP framework.
 *
 * @package   Fuel\Validation
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */


/**
* Provides a simple class with a magic toString method, used for testing objects that can be cast to strings.
*
* @package Fuel\Validation\Rule
* @author  Fuel Development Team
*/
class ClassWithToString
{
    function __toString()
    {
        return '1234567890';
    }

}
