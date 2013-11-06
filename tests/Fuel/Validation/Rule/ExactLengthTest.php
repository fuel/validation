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
			array('hello', 1, false),
			array('', 1, false),
			array('12345', 5, true),
			array('test.email.user@test.domain.tld', 500, false),
			array('b', 1, true),
			array('ä', 1, true),
			array('', 0, true),
			array('', -1, false),
			array('z', 0, false),
			array(new \stdClass(), 100, false),
			array(new \stdClass(), null, true),
			array(new \ClassWithToString(), 1, false),
			array(new \ClassWithToString(), 10, true),
			array(new \ClassWithToString(), null, false),
			array(new \ClassWithToString(), 100000, false),
			array(function(){ return false; }, null, true),
			array(function(){ return false; }, 100, false),
			array('', null, true),
			array(null, 1, false),
			array("a", null, false),
			array(null, null, true)
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

}
