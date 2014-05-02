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
	 * Provides strings to test and expected results for testValidate
	 *
	 * @return array
	 */
	public function validateProvider()
	{
		return array(
			0 => array('', false, 1),
			1 => array(true, false, 1),
			2 => array(new \stdClass, false, 1),
			3 => array(1, true, 1),
			4 => array(0, false, 1),
			5 => array(2, true, 1),
			6 => array(20, true, 1),
			7 => array(5, false, 20),
			8 => array(19, false, 20),
			9 => array(20, true, 20),
			10 => array(21, true, 20),
			11 => array(2100, true, 20),
			12 => array(21, true, -10),
			13 => array(-20, false, -10),
			14 => array(-20, false, null),
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
