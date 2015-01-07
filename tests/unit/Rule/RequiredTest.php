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
			7 => array('', null, false, array()),
			8 => array(false, 'foo', true,
				array(
					'foo' => false,
				)
			),
			9 => array(0, null, false, array()),
		);
	}

}
