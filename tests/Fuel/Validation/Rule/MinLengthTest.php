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
 * Defines tests for MinLength
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @covers  Fuel\Validation\Rule\MinLength
 */
class MinLengthTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var MinLength
	 */
	protected $object;

	protected function setUp()
	{
		$this->object = new MinLength;
	}

	/**
	 * @coversDefaultClass __construct
	 * @coversDefaultClass getMessage
	 * @group              Validation
	 */
	public function testGetMessage()
	{
		$this->assertEquals(
			'The field does not satisfy the minimum length requirement.',
			$this->object->getMessage()
		);
	}

	/**
	 * @coversDefaultClass validate
	 * @dataProvider       validateProvider
	 * @group              Validation
	 */
	public function testValidate($stringValue, $minLength, $expected)
	{
		$this->object->setParameter($minLength);
		$this->assertEquals(
			$expected,
			$this->object->validate($stringValue)
		);
	}

	/**
	 * Provides sample data for testing the minimum length validation
	 *
	 * @return array
	 */
	public function validateProvider()
	{
		return array(
			0 => array('hello', 1, true),
			1 => array('', 1, false),
			2 => array('12345', 5, true),
			3 => array('test.email.user@test.domain.tld', 500, false),
			4 => array('ä', 1, true),
			5 => array('', 0, true),
			6 => array('', -1, true),
			7 => array('z', 0, true),
			8 => array(new \stdClass(), 100, false),
			9 => array(new \stdClass(), null, false),
			10 => array(new \ClassWithToString(), 1, true),
			11 => array(new \ClassWithToString(), null, false),
			12 => array(new \ClassWithToString(), 100000, false),
			13 => array(function(){ return false; }, null, false),
			14 => array('', null, false),
			15 => array(null, 1, false),
			16 => array(null, null, false)
		);
	}

	/**
	 * @coversDefaultClass getMessageParameters
	 * @group              Validation
	 */
	public function testGetMessageParams()
	{
		$parameter = 12;

		$this->object->setParameter($parameter);

		$this->assertEquals(
			array('minLength' => $parameter),
			$this->object->getMessageParameters()
		);
	}

}
