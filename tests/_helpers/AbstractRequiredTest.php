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

class AbstractRequiredTest extends AbstractRuleTest
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
	 * @dataProvider validateProvider
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
			1 => array('', null, false, null),
			2 => array(array(), null, false, null),
			3 => array(null, null, false, null),
			4 => array(false, null, false, null),

			5 => array('test string 5', 'test', false,
				array()
			),

			6 => array('test string 6', 'test', false,
				array(
					'foo' => 'bar',
					'baz' => 'bat',
				)
			),

			7 => array('test string 7', 'test', true,
				array(
					'foo' => 'bar',
					'test' => 'value',
					'baz' => 'bat',
				)
			),

			8 => array('bla', 'test', true, null),
			9 => array('', 'test', false, null),
			10 => array('bla', null, false, array()),
			11 => array('', null, false, array()),

			12 => array(false, 'foo', true,
				array(
					'foo' => false,
				)
			),
			13 => array(true, 'foo', true,
				array(
					'foo' => true,
				)
			),

			14 => array(false, 'bar', true,
				array(
					'bar' => false,
				)
			),
			15 => array(0, 'test', true,
				array(
					'foo' => 'bar',
					'test' => 0,
					'baz' => 'bat',
				)
			),
			16 => array(0, 'test', true, array('test' => 0)),
			17 => array('0', 'foo', true,
				array(
					'foo' => '0',
				)
			),
		);
	}

}
