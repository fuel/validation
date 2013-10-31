<?php

/**
 * Part of the FuelPHP framework.
 *
 * @package   Fuel\Validation
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */

namespace Fuel\Validation\Rule;

/**
 * Class NumberTest
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 */
class NumberTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var Number
	 */
	protected $object;

	protected function setUp()
	{
		$this->object = new Number;
	}

	/**
	 * @covers \Fuel\Validation\Rule\Number::__construct
	 * @covers \Fuel\Validation\Rule\Number::getMessage
	 * @group  Validation
	 */
	public function testGetMessage()
	{
		$this->assertEquals(
			'The field is not valid number.',
			$this->object->getMessage()
		);
	}

	/**
	 * @covers \Fuel\Validation\Rule\Number::getMessage
	 * @covers \Fuel\Validation\Rule\Number::setMessage
	 * @group  Validation
	 */
	public function testSetGetMessage()
	{
		$message = 'This is a message used for testing.';

		$this->object->setMessage($message);

		$this->assertEquals(
			$message,
			$this->object->getMessage()
		);
	}

	/**
	 * @covers \Fuel\Validation\Rule\Number::validate
	 * @dataProvider validateProvider
	 * @group  Validation
	 */
	public function testValidate($value, $expected)
	{
		$this->assertEquals(
			$expected,
			$this->object->validate($value)
		);
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
