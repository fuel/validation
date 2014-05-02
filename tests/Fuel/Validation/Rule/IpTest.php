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
 * Tests for Ip
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @covers Fuel\Validation\Rule\Ip
 */
class IpTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var Ip
	 */
	protected $object;

	protected function setUp()
	{
		$this->object = new Ip;
	}

	/**
	 * @coversDefaultClass getMessage
	 * @group              Validation
	 */
	public function testGetMessage()
	{
		$this->assertEquals(
			 'The field is not a valid IP address.',
			 $this->object->getMessage()
		);
	}

	/**
	 * @coversDefaultClass validate
	 * @dataProvider       validateProvider
	 * @group              Validation
	 */
	public function testValidate($ip, $expected)
	{
		$this->assertEquals(
			$expected,
			$this->object->validate($ip)
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
			array('', false),
			array(1, false),
			array(true, false),
			array(new \stdClass, false),
			array('512.123.1254.34234', false),
			array('192.168.0.1', true),
			array('FE80::0202:B3FF:FE1E:8329', true),
			array('FE80:0000:0000:0000:0202:B3FF:FE1E:8329', true),
			array('ZZZZ::ZZZZ:ZZZZ', false),
			array('ZZZZ:ZZZZ', false),
			array('ZZZZ::ZZZZ:ZZZZ:ZZZZ:ZZZZ', false),
			array('ZZZZ:ZZZZ:ZZZZ:ZZZZ:ZZZZ:ZZZZ:ZZZZ:ZZZ', false),
		);
	}

}
