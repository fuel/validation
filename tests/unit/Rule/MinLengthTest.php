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
	 * {@inheritdocs}
	 */
	public function validateProvider()
	{
		return array(
			array('hello', true, 1),
			array('', false, 1),
			array('12345', true, 5),
			array('test.email.user@test.domain.tld', false, 500),
			array('ä', true, 1),
			array('', true, 0),
			array('', true, -1),
			array('z', true, 0),
			array(new \stdClass(), false, 100),
			array(new \stdClass(), false, null),
			array(new \ClassWithToString(), true, 1),
			array(new \ClassWithToString(), false, null),
			array(new \ClassWithToString(), false, 100000),
			array(function(){ return false; }, false, null),
			array('', false, null),
			array(null, false, 1),
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
