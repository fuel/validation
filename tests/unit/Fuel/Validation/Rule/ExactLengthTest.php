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
 * Tests the ExactLength class.
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @coversDefaultClass  \Fuel\Validation\Rule\ExactLength
 */
class ExactLengthTest extends AbstractRuleTest
{

	/**
	 * {@inheritdocs}
	 */
	protected $message = 'The length of the field is not exactly equal to the length specified.';

	protected function _before()
	{
		$this->object = new ExactLength;
	}

	/**
	 * Provides sample data for testing the exact length validation
	 *
	 * @return array
	 */
	public function validateProvider()
	{
		return array(
			0 => array('hello', false, 1),
			1 => array('', false, 1),
			2 => array('12345', true, 5),
			3 => array('test.email.user@test.domain.tld', false, 500),
			4 => array('b', true, 1),
			5 => array('ä', true, 1),
			6 => array('', true, 0),
			7 => array('', false, -1),
			8 => array('z', false, 0),
			9 => array(new \stdClass(), false, 100),
			10 => array(new \stdClass(), false, null),
			11 => array(new \ClassWithToString(), false, 1),
			12 => array(new \ClassWithToString(), true, 10),
			13 => array(new \ClassWithToString(), false, null),
			14 => array(new \ClassWithToString(), false, 100000),
			15 => array(function(){ return false; }, false, null),
			16 => array(function(){ return false; }, false, 100),
			17 => array('', false, null),
			18 => array(null, false, 1),
			19 => array("a", false, null),
			20 => array(null, false, null)
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
			array('length' => $parameter),
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
