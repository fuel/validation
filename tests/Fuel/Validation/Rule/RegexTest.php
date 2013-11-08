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
 * Tests for Regex
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @covers Fuel\Validation\Rule\Regex
 */
class RegexTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var Regex
	 */
	protected $object;

	protected function setUp()
	{
		$this->object = new Regex;
	}

	/**
	 * @coversDefaultClass getMessage
	 * @group              Validation
	 */
	public function testGetMessage()
	{
		$this->assertEquals(
			 'The field does not match the given pattern.',
			 $this->object->getMessage()
		);
	}

	/**
	 * @coversDefaultClass validate
	 * @dataProvider       validateProvider
	 * @group              Validation
	 */
	public function testValidate($value, $pattern, $expected)
	{
		$this->object->setParameter($pattern);

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
			0 => array('', null, false),
			1 => array(1, '/.*/', false),
			2 => array(true, '/.*/', false),
			3 => array(new \stdClass, '/.*/', false),
			4 => array('hkjsghfkjgJHga', '/[a-zA-Z]*/', true),
			5 => array('', '/.*/', true),
			6 => array('ads123', '/^[a-z]*$/', false),
			7 => array('ads', '/[a-z]*/', true),
		);
	}

	/**
	 * @coversDefaultClass __construct
	 * @coversDefaultClass getMessage
	 * @group              Validation
	 */
	public function testCustomMessageOnConstruct()
	{
		$message = 'foobar';

		$object = new Regex(null, $message);

		$this->assertEquals(
			$message,
			$object->getMessage()
		);
	}

}
