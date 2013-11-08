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

require_once(__DIR__.'/../../../ClassWithToString.php');

/**
 * Tests the MaxLength class.
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @covers  \Fuel\Validation\Rule\MaxLength
 */
class MaxLengthTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var MaxLength
	 */
	protected $object;

	protected function setUp()
	{
		$this->object = new MaxLength;
	}

	/**
	 * @coversDefaultClass __construct
	 * @coversDefaultClass getMessage
	 * @group              Validation
	 */
	public function testGetMessage()
	{
		$this->assertEquals(
			'The field is longer than the allowed maximum length.',
			$this->object->getMessage()
		);
	}

	/**
	 * @coversDefaultClass validate
	 * @dataProvider       validateProvider
	 * @group              Validation
	 */
	public function testValidate($stringValue, $maxLength, $expected)
	{
		$this->object->setParameter($maxLength);
		$this->assertEquals(
			$expected,
			$this->object->validate($stringValue)
		);
	}

	/**
	 * Provides sample data for testing the maximum length validation
	 *
	 * @return array
	 */
	public function validateProvider()
	{
		return array(
			0 => array('hello', 1, false),
			1 => array('', 1, true),
			2 => array('12345', 5, true),
			3 => array('test.email.user@test.domain.tld', 500, true),
			4 => array('b', 1, true),
			5 => array('ä', 1, true),
			6 => array('', 0, true),
			7 => array('', -1, false),
			8 => array('z', 0, false),
			9 => array(new \stdClass(), 100, true),
			10 => array(new \stdClass(), null, false),
			11 => array(new \ClassWithToString(), 1, false),
			12 => array(new \ClassWithToString(), null, false),
			13 => array(new \ClassWithToString(), 100000, true),
			14 => array(function(){ return false; }, null, false),
			15 => array(function(){ return false; }, 100, true),
			16 => array('', null, false),
			17 => array(null, 1, true),
			18 => array("a", null, false),
			19 => array(null, null, false)
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

		$object = new MaxLength(null, $message);

		$this->assertEquals(
			$message,
			$object->getMessage()
		);
	}

}
