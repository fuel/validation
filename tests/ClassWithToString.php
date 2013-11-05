<?php
/**
* Class ClassWithToString
*
* @package Fuel\Validation\Rule
* @author  Fuel Development Team
*/
class ClassWithToString
{
function __toString()
{
return '1234567890'; //returns string of length 10.
}

}