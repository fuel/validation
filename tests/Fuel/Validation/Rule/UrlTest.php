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
 * Tests for ValidUrl
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @covers Fuel\Validation\Rule\Url
 */
class UrlTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var Url
	 */
	protected $object;

	protected function setUp()
	{
		$this->object = new Url;
	}

	/**
	 * @coversDefaultClass getMessage
	 * @group              Validation
	 */
	public function testGetMessage()
	{
		$this->assertEquals(
			 'The field is not a valid url.',
			 $this->object->getMessage()
		);
	}

	/**
	 * @coversDefaultClass validate
	 * @dataProvider       validateProvider
	 * @group              Validation
	 */
	public function testValidate($url, $expected)
	{
		$this->assertEquals(
			$expected,
			$this->object->validate($url)
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
			array('http://fuelphp.com', true),
			array('http://fuelphp', true),
			array('fuelphp.com', false),
			array('sftp://user:password@fuelphp.com', true),
			array('http://192.168.0.1', true),
			array('ftp://FE80::0202:B3FF:FE1E:8329', true),
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

		$object = new Url(null, $message);

		$this->assertEquals(
			$message,
			$object->getMessage()
		);
	}

}
