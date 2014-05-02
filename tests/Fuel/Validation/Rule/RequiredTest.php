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
 * @covers  Fuel\Validation\Rule\Required
 */
class RequiredTest extends AbstractTest
{

	/**
	 * {@inheritdocs}
	 */
	protected $message = 'The field is required and has not been specified.';

	protected function setUp()
	{
		$this->object = new Required;
	}

	/**
	 * @coversDefaultClass validate
	 * @dataProvider       validateProvider
	 * @group              Validation
	 */
	public function testValidate($value, $field, $expected, $data)
	{
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
		);
	}

}
