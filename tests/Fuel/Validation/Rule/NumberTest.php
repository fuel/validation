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

/**
 * Tests for Number validation rule
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @covers  Fuel\Validation\Rule\Number
 */
class NumberTest extends AbstractTest
{

	protected function setUp()
	{
		$this->object = new Number;
		$this->message = 'The field is not valid number.';
	}

	/**
	 * Provides strings to test and expected results for testValidate
	 *
	 * @return array
	 */
	public function validateProvider()
	{
		return array(
			array('123', true),
			array('016547', true),
			array('ghjgsd(*^"36723863*&723', false),
			array('a', false),
		);
	}

}
