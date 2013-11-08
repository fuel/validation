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
 * Tests for NumericBetween
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @covers Fuel\Validation\Rule\NumericBetween
 */
class NumericBetweenTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var NumericMax
	 */
	protected $object;

	protected function setUp()
	{
		$this->object = new NumericBetween;
	}

	/**
	 * @coversDefaultClass getMessage
	 * @group              Validation
	 */
	public function testGetMessage()
	{
		$this->assertEquals(
			'The field is not between the specified values.',
			 $this->object->getMessage()
		);
	}

	/**
	 * @coversDefaultClass validate
	 * @dataProvider       validateProvider
	 * @group              Validation
	 */
	public function testValidate($value, $lower, $upper, $expected)
	{
		$this->object->setParameter(array($lower, $upper));

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
			0 => array('', 1, 2, false),
			1 => array(true, 1, 2, false),
			2 => array(new \stdClass, 1, 2, false),
			3 => array(1, 1, 10, false),
			4 => array(2, 1, 10, true),
			5 => array(9, 1, 10, true),
			6 => array(10, 1, 10, false),
			6 => array(11, 1, 10, false),
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

		$object = new NumericBetween(null, $message);

		$this->assertEquals(
			$message,
			$object->getMessage()
		);
	}

	/**
	 * @coversDefaultClass validate
	 * @group              Validation
	 */
	public function testValidateWithNoParam()
	{
		$this->assertFalse(
			$this->object->validate(5)
		);
	}

	/**
	 * @coversDefaultClass getMessageParameters
	 * @group              Validation
	 */
	public function testGetMessageParams()
	{
		$this->object->setParameter(array(1, 10));

		$this->assertEquals(
			array(
				'lowerBound' => 1,
				'upperBound' => 10,
			),
			$this->object->getMessageParameters()
		);
	}

	/**
	 * @coversDefaultClass getMessageParameters
	 * @group              Validation
	 */
	public function testGetMessageParamsEmpty()
	{
		$this->assertEquals(
			array(
				'lowerBound' => null,
				'upperBound' => null,
			),
			$this->object->getMessageParameters()
		);
	}

}
