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
 * Tests the ExactLength class.
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @covers  \Fuel\Validation\Rule\ExactLength
 */
class ExactLengthTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var ExactLength
	 */
	protected $object;

	protected function setUp()
	{
		$this->object = new ExactLength;
	}

	/**
	 * @coversDefaultClass __construct
	 * @coversDefaultClass getMessage
	 * @group              Validation
	 */
	public function testGetMessage()
	{
		$this->assertEquals(
			'The length of the field is not exactly equal to the length specified.',
			$this->object->getMessage()
		);
	}

	/**
	 * @coversDefaultClass validate
	 * @dataProvider       validateProvider
	 * @group              Validation
	 */
	public function testValidate($stringValue, $exactLength, $expected)
	{
		$this->object->setParameter($exactLength);
		$this->assertEquals(
			$expected,
			$this->object->validate($stringValue)
		);
	}

	/**
	 * Provides sample data for testing the exact length validation
	 *
	 * @return array
	 */
	public function validateProvider()
	{

		return array(
			0 => array('hello', 1, false),
			1 => array('', 1, false),
			2 => array('12345', 5, true),
			3 => array('test.email.user@test.domain.tld', 500, false),
			4 => array('b', 1, true),
			5 => array('ä', 1, true),
			6 => array('', 0, true),
			7 => array('', -1, false),
			8 => array('z', 0, false),
			9 => array(new \stdClass(), 100, false),
			10 => array(new \stdClass(), null, false),
			11 => array(new \ClassWithToString(), 1, false),
			12 => array(new \ClassWithToString(), 10, true),
			13 => array(new \ClassWithToString(), null, false),
			14 => array(new \ClassWithToString(), 100000, false),
			15 => array(function(){ return false; }, null, false),
			16 => array(function(){ return false; }, 100, false),
			17 => array('', null, false),
			18 => array(null, 1, false),
			19 => array("a", null, false),
			20 => array(null, null, false)
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

		$object = new ExactLength(null, $message);

		$this->assertEquals(
			$message,
			$object->getMessage()
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
			array('length' => $parameter),
			$this->object->getMessageParameters()
		);
	}

}
