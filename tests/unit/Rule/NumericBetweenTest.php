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

class NumericBetweenTest extends AbstractRuleTest
{

	/**
	 * {@inheritdocs}
	 */
	protected $message = 'The field is not between the specified values.';

	protected function _before()
	{
		$this->object = new NumericBetween;
	}

	/**
	 * {@inheritdocs}
	 */
	public function validateProvider()
	{
		return array(
			0 => array('', false, array(1, 2)),
			1 => array(true, false, array(1, 2)),
			2 => array(new \stdClass, false, array(1, 2)),
			3 => array(0, false, array(1, 10)),
			4 => array(1, true, array(1, 10)),
			5 => array(2, true, array(1, 10)),
			6 => array(9, true, array(1, 10)),
			7 => array(10, true, array(1, 10)),
			8 => array(11, false, array(1, 10)),
		);
	}

	public function testValidateWithNoParam()
	{
		$this->assertFalse(
			$this->object->validate(5)
		);
	}

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
