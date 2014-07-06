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
 * Defines tests for MatchField
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @coversDefaultClass  \Fuel\Validation\Rule\MatchField
 */
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

	/**
	 * @covers ::validate
	 * @group  Validation
	 */
	public function testRequiredParameters()
	{
		$this->assertFalse(
			$this->object->validate('random value')
		);
	}

	/**
	 * @covers ::validate
	 * @group  Validation
	 */
	public function testNoParameter()
	{
		$data = array();

		$this->assertFalse(
			$this->object->validate('random value', 'field_name', $data)
		);
	}

	/**
	 * @covers       ::validate
	 * @dataProvider validateProvider
	 * @group        Validation
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

	/**
	 * @covers ::getMessageParameters
	 * @group  Validation
	 */
	public function testGetMessageParams()
	{
		$parameter = 'some other field';

		$this->object->setParameter($parameter);

		$this->assertEquals(
			array('field' => $parameter),
			$this->object->getMessageParameters()
		);
	}

	/**
	 * @covers ::setParameter
	 * @group  Validation
	 */
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
