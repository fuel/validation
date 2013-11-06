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
 * Class MatchFieldTest
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @covers  \Fuel\Validation\Rule\MatchField
 */
class MatchFieldTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var MatchField
	 */
	protected $object;

	protected function setUp()
	{
		$this->object = new MatchField;
	}

	/**
	 * @coversDefaultClass __construct
	 * @coversDefaultClass getMessage
	 * @group              Validation
	 */
	public function testGetMessage()
	{
		$this->assertEquals(
			'The field does not match the other given field.',
			$this->object->getMessage()
		);
	}

	/**
	 * @coversDefaultClass validate
	 * @group              Validation
	 */
	public function testRequiredParameters()
	{
		$this->assertFalse(
			$this->object->validate('random value')
		);
	}

	/**
	 * @coversDefaultClass validate
	 * @group              Validation
	 */
	public function testNoParameter()
	{
		$data = array();

		$this->assertFalse(
			$this->object->validate('random value', 'field_name', $data)
		);
	}

	/**
	 * @coversDefaultClass validate
	 * @dataProvider       validateProvider
	 * @group              Validation
	 */
	public function testValidate($fieldA, $fieldB, $expected, $data)
	{
		$this->object->setParameter($fieldB);

		$this->assertEquals(
			$expected,
			$this->object->validate($data[$fieldA], $fieldA, $data)
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

}
