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
 * Tests for Regex
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @coversDefaultClass \Fuel\Validation\Rule\Regex
 */
class RegexTest extends AbstractRuleTest
{

	/**
	 * {@inheritdocs}
	 */
	protected $message = 'The field does not match the given pattern.';

	protected function _before()
	{
		$this->object = new Regex;
	}

	/**
	 * Provides strings to test and expected results for testValidate
	 *
	 * @return array
	 */
	public function validateProvider()
	{
		return array(
			array('', false, null),
			array(1, false, '/.*/'),
			array(true, false, '/.*/'),
			array(new \stdClass, false, '/.*/'),
			array('hkjsghfkjgJHga', true, '/[a-zA-Z]*/'),
			array('', true, '/.*/'),
			array('ads123', false, '/^[a-z]*$/'),
			array('ads', true, '/[a-z]*/'),
		);
	}

	/**
	 * @covers ::getMessageParameters
	 * @group  Validation
	 */
	public function testGetMessageParams()
	{
		$parameter = '/.*/';

		$this->object->setParameter($parameter);

		$this->assertEquals(
			array('pattern' => $parameter),
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
