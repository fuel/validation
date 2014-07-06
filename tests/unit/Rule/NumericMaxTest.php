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

	protected function _before()
	{
		$this->object = new NumericMax;
	}

	/**
	 * {@inheritdocs}
	 */
	public function validateProvider()
	{
		return array(
			array('', false, 1),
			array(true, false, 1),
			array(new \stdClass, false, 1),
			array(1, true, 1),
			array(0, true, 1),
			array(2, false, 1),
			array(20, false, 1),
			array(5, true, 20),
			array(19, true, 20),
			array(20, true, 20),
			array(21, false, 20),
			array(2100, false, 20),
			array(21, false, -10),
			array(-20, true, -10),
			array(-20, false, null),
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

	/**
	 * @covers ::setParameter
	 * @group  Validation
	 */
	public function testSetParameter()
	{
		$parameter = array(12);

		$this->object->setParameter($parameter);

		$this->assertEquals(
			12,
			$this->object->getParameter()
		);
	}

}
