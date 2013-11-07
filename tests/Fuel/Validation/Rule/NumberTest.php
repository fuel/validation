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
	 * @coversDefaultClass __construct
	 * @coversDefaultClass getMessage
	 * @group              Validation
	 */
	public function testGetMessage()
	{
		$this->assertEquals(
			'The field is not valid number.',
			$this->object->getMessage()
		);
	}

	/**
	 * @coversDefaultClass getMessage
	 * @coversDefaultClass setMessage
	 * @group              Validation
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
	 * @coversDefaultClass validate
	 * @dataProvider       validateProvider
	 * @group              Validation
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

	/**
	 * @coversDefaultClass getMessage
	 * @coversDefaultClass __construct
	 * @group              Validation
	 */
	public function testCustomMessageOnConstruct()
	{
		$message = 'foobarbazbat';

		$object = new Number(null, $message);

		$this->assertEquals(
			$message,
			$object->getMessage()
		);
	}

}
