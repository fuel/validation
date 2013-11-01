<?php

/**
 * Part of the FuelPHP framework.
 *
 * @package   Fuel\Validation
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */

namespace Fuel\Validation;

use Fuel\Validation\Rule\Email;
use Fuel\Validation\Rule\Number;

/**
 * Tests for the Validation class
 *
 * @package Fuel\Validation
 * @author  Fuel Development Team
 */
class ValidationTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var Validation
	 */
	protected $object;

	/**
	 * Contains some test fields with rules
	 *
	 * @var array
	 */
	protected $testFields;

	protected function setUp()
	{
		$this->object = new Validation;

		$this->testFields = array(
			'email' => array(
				new Email(),
			),
			'age' => array(
				new Number(),
			),
		);
	}

	/**
	 * Adds sample fields and rules to the validation object
	 */
	protected function addTestRules()
	{
		foreach ($this->testFields as $field => $rules)
		{
			$this->object->addField($field);

			foreach ($rules as $rule)
			{
				$this->object->addRule($field, $rule);
			}
		}
	}

	/**
	 * @covers            \Fuel\Validation\Validation::getRules
	 * @expectedException \Fuel\Validation\Exception\InvalidField
	 * @group             Validation
	 */
	public function testGetRulesForUnknown()
	{
		$this->object->getRules('fake');
	}

	/**
	 * @covers \Fuel\Validation\Validation::getRules
	 * @covers \Fuel\Validation\Validation::addField
	 * @group  Validation
	 */
	public function testAddField()
	{
		$field = 'test field';

		$this->object->addField($field);

		$this->assertEquals(
			array(),
			$this->object->getRules($field)
		);
	}

	/**
	 * @covers \Fuel\Validation\Validation::getRules
	 * @covers \Fuel\Validation\Validation::addRule
	 * @group  Validation
	 */
	public function testGetFieldRules()
	{
		$this->addTestRules();

		$this->assertEquals(
			$this->testFields['email'],
			$this->object->getRules('email')
		);
	}

	/**
	 * @covers \Fuel\Validation\Validation::getRules
	 * @covers \Fuel\Validation\Validation::addRule
	 * @group  Validation
	 */
	public function testGetAllRules()
	{
		$this->addTestRules();

		$this->assertEquals(
			$this->testFields,
			$this->object->getRules()
		);
	}

	/**
	 * @covers \Fuel\Validation\Validation::run
	 * @covers \Fuel\Validation\Validation::validateField
	 * @group  Validation
	 */
	public function testRun()
	{
		$fieldName = 'email';

		$this->object->addRule($fieldName, new Email());

		$this->assertTrue(
			$this->object->run(array(
					$fieldName => 'user@domain.example',
				)
			)
		);
	}

	/**
	 * @covers \Fuel\Validation\Validation::run
	 * @covers \Fuel\Validation\Validation::validateField
	 * @group  Validation
	 */
	public function testRunFailure()
	{
		$fieldName = 'email';

		$this->object->addRule($fieldName, new Email());

		$this->assertFalse(
			$this->object->run(array(
					$fieldName => 'example',
				)
			)
		);
	}


}
