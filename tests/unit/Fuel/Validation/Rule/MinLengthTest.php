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
 * Defines tests for MinLength
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @coversDefaultClass  \Fuel\Validation\Rule\MinLength
 */
class MinLengthTest extends AbstractRuleTest
{

	/**
	 * {@inheritdocs}
	 */
	protected $message = 'The field does not satisfy the minimum length requirement.';

	protected function _before()
	{
		$this->object = new MinLength;
	}

	/**
	 * Provides sample data for testing the minimum length validation
	 *
	 * @return array
	 */
	public function validateProvider()
	{
		return array(
			0 => array('hello', true, 1),
			1 => array('', false, 1),
			2 => array('12345', true, 5),
			3 => array('test.email.user@test.domain.tld', false, 500),
			4 => array('ä', true, 1),
			5 => array('', true, 0),
			6 => array('', true, -1),
			7 => array('z', true, 0),
			8 => array(new \stdClass(), false, 100),
			9 => array(new \stdClass(), false, null),
			10 => array(new \ClassWithToString(), true, 1),
			11 => array(new \ClassWithToString(), false, null),
			12 => array(new \ClassWithToString(), false, 100000),
			13 => array(function(){ return false; }, false, null),
			14 => array('', false, null),
			15 => array(null, false, 1),
			16 => array(null, false, null)
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
			array('minLength' => $parameter),
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
