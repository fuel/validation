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
 * Tests for Invalid
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @coversDefaultClass Fuel\Validation\Rule\Invalid
 */
class InvalidTest extends AbstractRuleTest
{

	/**
	 * {@inheritdocs}
	 */
	protected $message = 'The field is invalid and has been specified.';

	protected function _before()
	{
		$this->object = new Invalid;
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
	 * {@inheritdocs}
	 */
	public function validateProvider()
	{
		return array(
			0 => array('admin@test.com', null, false, null),
			1 => array('', null, true, null),
			2 => array(array(), null, true, null),
			3 => array(null, null, true, null),
			4 => array(false, null, false, null),

			5 => array('test string 5', 'test', true,
				array()
			),

			6 => array('test string 6', 'test', true,
				array(
					'foo' => 'bar',
					'baz' => 'bat',
				)
			),

			7 => array('test string 7', 'test', false,
				array(
					'foo' => 'bar',
					'test' => 'value',
					'baz' => 'bat',
				)
			),

			8 => array('bla', 'test', false, null),
			9 => array('', 'test', true, null),
			10 => array('bla', null, false, array()),
			11 => array('', null, true, array()),

			12 => array(false, 'foo', false,
				array(
					'foo' => false,
				)
			),
			13 => array(true, 'foo', false,
				array(
					'foo' => true,
				)
			),

			14 => array(0, 'bar', false,
				array(
					'bar' => false,
				)
			),
		);
	}

}
