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

class MatchFieldTest extends AbstractRuleTest
{

	/**
	 * {@inheritdocs}
	 */
	protected $message = 'The field does not match the other given field.';

	protected function _before()
	{
		$this->object = new MatchField;
	}

	public function testRequiredParameters()
	{
		$this->assertFalse(
			$this->object->validate('random value')
		);
	}

	public function testNoParameter()
	{
		$data = array();

		$this->assertFalse(
			$this->object->validate('random value', 'field_name', $data)
		);
	}

	/**
	 * @dataProvider validateProvider
	 */
	public function testValidate()
	{
		list($fieldA, $fieldB, $expected, $data) = func_get_args();

		$this->object->setParameter($fieldB);

		$this->assertEquals(
			$expected,
			$this->object->validate($data[$fieldA], $fieldA, $data)
		);
	}

	/**
	 * {@inheritdocs}
	 */
	public function validateProvider()
	{
		return array(
			array('a', 'b', true,
				array(
					'a' => 'a',
					'b' => 'a',
				),
			),

			array('a', 'b', false,
				array(
					'a' => 'a',
					'b' => 'b',
				),
			),

			array('a', 'b', false,
				array(
					'a' => 'a',
				),
			),
		);
	}

	public function testGetMessageParams()
	{
		$parameter = 'some other field';

		$this->object->setParameter($parameter);

		$this->assertEquals(
			array('field' => $parameter),
			$this->object->getMessageParameters()
		);
	}

	public function testSetParameter()
	{
		$parameter = array('some other field');

		$this->object->setParameter($parameter);

		$this->assertEquals(
			'some other field',
			$this->object->getParameter()
		);
	}

}
