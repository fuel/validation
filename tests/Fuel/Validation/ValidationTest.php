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

	/**
	 * @covers       \Fuel\Validation\Validation::run
	 * @covers       \Fuel\Validation\Validation::validateField
	 * @dataProvider runMultipleFieldsData
	 * @group        Validation
	 */
	public function testRunMultipleFields($expected, $data)
	{
		$this->addTestRules();

		$this->assertEquals(
			$expected,
			$this->object->run($data)
		);
	}

	/**
	 * Provides various data sets to test validation running
	 *
	 * @return array
	 */
	public function runMultipleFieldsData()
	{
		return array(
			array(true, array('email' => 'user@domain.example', 'age' => 12)),
			array(false, array('email' => 'example', 'age' => 12)),
			array(false, array('email' => 'user@domain.example', 'age' => 'asdasd')),
			array(true, array('email' => 'user@domain.example')),
			array(true, array('age' => 12)),
			array(true, array()),
		);
	}

	/**
	 * @covers \Fuel\Validation\Validation::getMessages
	 * @covers \Fuel\Validation\Validation::hasRun
	 * @covers \Fuel\Validation\Validation::reset
	 * @group  Validation
	 */
	public function testReset()
	{
		$this->object->reset();

		// Check that hasRun has been reset
		$this->assertFalse(
			$this->object->hasRun()
		);

		// Check that messages have been reset
		$this->assertEquals(
			array(),
			$this->object->getMessages()
		);
	}

	/**
	 * @covers \Fuel\Validation\Validation::run
	 * @covers \Fuel\Validation\Validation::hasRun
	 * @group  Validation
	 */
	public function testHasRun()
	{
		$this->assertFalse(
			$this->object->hasRun()
		);

		$this->object->run(array());

		$this->assertTrue(
			$this->object->hasRun()
		);
	}

	/**
	 * @covers \Fuel\Validation\Validation::getMessages
	 * @covers \Fuel\Validation\Validation::run
	 * @covers \Fuel\Validation\Validation::validateField
	 * @group  Validation
	 */
	public function testGetMessages()
	{
		$this->addTestRules();

		$this->assertEquals(
			array(),
			$this->object->getMessages()
		);

		// Fail some validation
		$this->object->run(array(
				'email' => 'asdasd',
				'age' => 'asdasd',
			)
		);

		// Set up an expected result
		$expected = array(
			'email' => $this->testFields['email'][0]->getMessage(),
			'age' => $this->testFields['age'][0]->getMessage(),
		);

		// Check for that
		$this->assertEquals(
			$expected,
			$this->object->getMessages()
		);
	}
}
