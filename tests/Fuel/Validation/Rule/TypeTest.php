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
 * Defines tests for Type
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @covers  Fuel\Validation\Rule\Type
 */
class TypeTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var Type
	 */
	protected $object;

	protected function setUp()
	{
		$this->object = new Type;
	}

	/**
	 * @coversDefaultClass __construct
	 * @coversDefaultClass getMessage
	 * @group              Validation
	 */
	public function testGetMessage()
	{
		$this->assertEquals(
			'The field is not one of the given type(s).',
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
	public function testValidate($value, $type, $expected)
	{
		$this->object->setParameter($type);
		$this->assertEquals(
			$expected,
			$this->object->validate($value)
		);
	}

	/**
	 * Provides sample data for testing the email validation
	 *
	 * @return array
	 */
	public function validateProvider()
	{
		return array(
			0 => array('admin@test.com', 'string', true),
			1 => array('admin@test.com', 'numeric', false),
			2 => array('admin@test.com', 'stdClass', false),
			3 => array('admin@test.com', array('numeric', 'string'), true),
			4 => array(1, 'numeric', true),
			5 => array(1, 'int', true),
			6 => array(1, 'string', false),
			7 => array(1, 'stdClass', false),
			8 => array(1, array('string', 'int'), true),
			9 => array(1, null, false),
			10 => array(new \stdClass(), 'stdClass', true),
			11 => array(new \stdClass(), 'string', false),
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

		$object = new Type(null, $message);

		$this->assertEquals(
			$message,
			$object->getMessage()
		);
	}

}
