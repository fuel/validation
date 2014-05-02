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
 * @covers Fuel\Validation\Rule\Regex
 */
class RegexTest extends AbstractRuleTest
{

	/**
	 * {@inheritdocs}
	 */
	protected $message = 'The field does not match the given pattern.';

	protected function setUp()
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
			0 => array('', false, null),
			1 => array(1, false, '/.*/'),
			2 => array(true, false, '/.*/'),
			3 => array(new \stdClass, false, '/.*/'),
			4 => array('hkjsghfkjgJHga', true, '/[a-zA-Z]*/'),
			5 => array('', true, '/.*/'),
			6 => array('ads123', false, '/^[a-z]*$/'),
			7 => array('ads', true, '/[a-z]*/'),
		);
	}

	/**
	 * @coversDefaultClass getMessageParameters
	 * @group              Validation
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

}
