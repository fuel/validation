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
 * Defines tests for Email
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @covers  Fuel\Validation\Rule\Date
 */
class DateTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var Date
	 */
	protected $object;

	protected function setUp()
	{
		$this->object = new Date;
	}

	/**
	 * @coversDefaultClass __construct
	 * @coversDefaultClass getMessage
	 * @group              Validation
	 */
	public function testGetMessage()
	{
		$this->assertEquals(
			'The field does not contain a valid date.',
			$this->object->getMessage()
		);
	}

	/**
	 * @coversDefaultClass validate
	 * @dataProvider       validateProvider
	 * @group              Validation
	 */
	public function testValidate($dateValue, $format=null, $strict=true, $expected)
	{
		$this->object->setParameter(array('format' => $format, 'strict' => $strict));
		$this->assertEquals(
			$expected,
			$this->object->validate($dateValue)
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
			0 => array('admin@test.com', 'Y/m/d', true, false),
			1 => array('admin@test.com', null, true, false),
			2 => array('admin@test.com', 'Y/m/d', false, false),
			3 => array('admin@test.com', null, false, false),
			4 => array('10/41/10', 'Y/m/d', true, false),
			5 => array('10/41/10', null, true, false),
			6 => array('10/41/10', 'Y/m/d', false, false),
			7 => array('10/41/10', null, false, false),
			8 => array('10/10/10', 'Y/m/d', true, true),
			9 => array('10/10/10', null, true, false),
			10 => array('10/10/10', 'Y/m/d', false, true),
			11 => array('10/10/10', null, false, false),
			12 => array('2012/10/10', 'Y/m/d', true, true),
			13 => array('2012/10/10', null, true, false),
			14 => array('2012/10/10', 'Y/m/d', false, true),
			15 => array('2012/10/10', 'Y.m.d', false, false),
			16 => array('2012.10.10', 'Y.m.d', false, true),
			17 => array('2012/10/10', null, false, false),
			18 => array(new \stdClass(), "Y/m.d", false, false),
			19 => array(new \stdClass(), null, true, false),
			20 => array(new \ClassWithToString("1990/12/12"), "Y/m/d", true, true),
			21 => array(new \ClassWithToString(), "D/m/Y", true, false),
			22 => array(new \ClassWithToString(), null, true, false),
			23 => array(new \ClassWithToString(), 100000, true, false),
			23 => array(function(){ return "10/10/10"; }, "d/m/y", true, false),
		);
	}

}
