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
 * Tests for NumericMin
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @covers Fuel\Validation\Rule\NumericMin
 */
class NumericMinTest extends AbstractTest
{

	/**
	 * {@inheritdocs}
	 */
	protected $message = 'The field is not equal to or greater than the specified value.';

	protected function setUp()
	{
		$this->object = new NumericMin;
	}

	/**
	 * @coversDefaultClass validate
	 * @dataProvider       validateProvider
	 * @group              Validation
	 */
	public function testValidate($value, $param, $expected)
	{
		$this->object->setParameter($param);

		parent::testValidate($value, $expected);
	}

	/**
	 * Provides strings to test and expected results for testValidate
	 *
	 * @return array
	 */
	public function validateProvider()
	{
		return array(
			0 => array('', 1, false),
			1 => array(true, 1, false),
			2 => array(new \stdClass, 1, false),
			3 => array(1, 1, true),
			4 => array(0, 1, false),
			5 => array(2, 1, true),
			6 => array(20, 1, true),
			7 => array(5, 20, false),
			8 => array(19, 20, false),
			9 => array(20, 20, true),
			10 => array(21, 20, true),
			11 => array(2100, 20, true),
			12 => array(21, -10, true),
			13 => array(-20, -10, false),
			14 => array(-20, null, false),
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
			array('minValue' => $parameter),
			$this->object->getMessageParameters()
		);
	}

}
