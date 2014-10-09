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
	 * {@inheritdocs}
	 */
	public function validateProvider()
	{
		return array(
			0 => array('hello', false, 1),
			1 => array('', true, 1),
			2 => array('12345', true, 5),
			3 => array('test.email.user@test.domain.tld', true, 500),
			4 => array('b', true, 1),
			5 => array('ä', true, 1),
			6 => array('', true, 0),
			7 => array('', false, -1),
			8 => array('z', false, 0),
			9 => array(new \stdClass(), false, 100),
			10 => array(new \stdClass(), false, null),
			11 => array(new \ClassWithToString(), false, 1),
			12 => array(new \ClassWithToString(), false, null),
			13 => array(new \ClassWithToString(), true, 100000),
			14 => array(function(){ return false; }, false, null),
			15 => array(function(){ return false; }, false, 100),
			16 => array('', false, null),
			17 => array(null, true, 1),
			18 => array("a", false, null),
			19 => array(null, false, null)
		);
	}

	public function testGetMessageParams()
	{
		$parameter = 12;

		$this->object->setParameter($parameter);

		$this->assertEquals(
			array('maxLength' => $parameter),
			$this->object->getMessageParameters()
		);
	}

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
