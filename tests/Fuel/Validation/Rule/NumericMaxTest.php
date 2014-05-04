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
 * Tests for NumericMax
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @coversDefaultClass \Fuel\Validation\Rule\NumericMax
 */
class NumericMaxTest extends AbstractRuleTest
{

	/**
	 * {@inheritdocs}
	 */
	protected $message = 'The field is not equal to or less than the specified value.';

	protected function setUp()
	{
		$this->object = new NumericMax;
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
			4 => array(0, true, 1),
			5 => array(2, false, 1),
			6 => array(20, false, 1),
			7 => array(5, true, 20),
			8 => array(19, true, 20),
			9 => array(20, true, 20),
			10 => array(21, false, 20),
			11 => array(2100, false, 20),
			12 => array(21, false, -10),
			13 => array(-20, true, -10),
			14 => array(-20, false, null),
		);
	}

	/**
	 * @covers ::getMessageParameters
	 * @group  Validation
	 */
	public function testGetMessageParams()
	{
		$parameter = 12;

		$this->object->setParameter($parameter);

		$this->assertEquals(
			array('maxValue' => $parameter),
			$this->object->getMessageParameters()
		);
	}

}
