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
 * @coversDefaultClass \Fuel\Validation\Rule\NumericBetween
 */
class NumericBetweenTest extends AbstractRuleTest
{

	/**
	 * {@inheritdocs}
	 */
	protected $message = 'The field is not between the specified values.';

	protected function setUp()
	{
		$this->object = new NumericBetween;
	}

	/**
	 * Provides strings to test and expected results for testValidate
	 *
	 * @return array
	 */
	public function validateProvider()
	{
		return array(
			0 => array('', false, array(1, 2)),
			1 => array(true, false, array(1, 2)),
			2 => array(new \stdClass, false, array(1, 2)),
			3 => array(1, false, array(1, 10)),
			4 => array(2, true, array(1, 10)),
			5 => array(9, true, array(1, 10)),
			6 => array(10, false, array(1, 10)),
			6 => array(11, false, array(1, 10)),
		);
	}

	/**
	 * @covers ::validate
	 * @covers ::paramsValid
	 * @group  Validation
	 */
	public function testValidateWithNoParam()
	{
		$this->assertFalse(
			$this->object->validate(5)
		);
	}

	/**
	 * @covers ::getMessageParameters
	 * @group  Validation
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
	 * @covers ::getMessageParameters
	 * @group  Validation
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
