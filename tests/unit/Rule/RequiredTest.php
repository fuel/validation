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
 * Tests for Required
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @coversDefaultClass \Fuel\Validation\Rule\Required
 */
class RequiredTest extends AbstractRuleTest
{

	/**
	 * {@inheritdocs}
	 */
	protected $message = 'The field is required and has not been specified.';

	protected function _before()
	{
		$this->object = new Required;
	}

	/**
	 * @covers       ::validate
	 * @dataProvider validateProvider
	 * @group        Validation
	 */
	public function testValidate()
	{
		list($value, $field, $expected, $data) = func_get_args();

		$this->assertEquals(
			$expected,
			$this->object->validate($value, $field, $data)
		);
	}

	/**
	 * Provides sample data for testing the email validation
	 *
	 * @return array
	 */
	public function validateProvider()
	{
		return array(
			array('admin@test.com', null, false, null),
			array('', null, false, null),
			array(array(), null, false, null),
			array(null, null, false, null),
			array(false, null, false, null),

			array('test string 5', 'test', false,
				array()
			),

			array('test string 6', 'test', false,
				array(
					'foo' => 'bar',
					'baz' => 'bat',
				)
			),

			array('test string 7', 'test', true,
				array(
					'foo' => 'bar',
					'test' => 'value',
					'baz' => 'bat',
				)
			),

			array('bla', 'test', true, null),
			array('', 'test', false, null),
			array('bla', null, false, array()),
			array('', null, false, array()),

			array(false, 'foo', true,
				array(
					'foo' => false,
				)
			),
			array(true, 'foo', true,
				array(
					'foo' => true,
				)
			),

			array(0, 'bar', true,
				array(
					'bar' => false,
				)
			),
		);
	}

}
