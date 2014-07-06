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
 * Tests the MaxLength class.
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @coversDefaultClass  \Fuel\Validation\Rule\MaxLength
 */
class MaxLengthTest extends AbstractRuleTest
{

	/**
	 * {@inheritdocs}
	 */
	protected $message = 'The field is longer than the allowed maximum length.';

	protected function _before()
	{
		$this->object = new MaxLength;
	}

	/**
	 * Provides sample data for testing the maximum length validation
	 *
	 * @return array
	 */
	public function validateProvider()
	{
		return array(
			array('hello', false, 1),
			array('', true, 1),
			array('12345', true, 5),
			array('test.email.user@test.domain.tld', true, 500),
			array('b', true, 1),
			array('ä', true, 1),
			array('', true, 0),
			array('', false, -1),
			array('z', false, 0),
			array(new \stdClass(), false, 100),
			array(new \stdClass(), false, null),
			array(new \ClassWithToString(), false, 1),
			array(new \ClassWithToString(), false, null),
			array(new \ClassWithToString(), true, 100000),
			array(function(){ return false; }, false, null),
			array(function(){ return false; }, false, 100),
			array('', false, null),
			array(null, true, 1),
			array("a", false, null),
			array(null, false, null),
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
			array('maxLength' => $parameter),
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
