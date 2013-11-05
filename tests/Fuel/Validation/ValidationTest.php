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
 *
 * @covers  \Fuel\Validation\Validation
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
	 * @var RuleInterface[][]
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
	 * @coversDefaultClass getRules
	 * @expectedException  \Fuel\Validation\Exception\InvalidField
	 * @group              Validation
	 */
	public function testGetRulesForUnknown()
	{
		$this->object->getRules('fake');
	}

	/**
	 * @coversDefaultClass getRules
	 * @coversDefaultClass addField
	 * @group              Validation
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
	 * @coversDefaultClass getRules
	 * @coversDefaultClass addRule
	 * @group              Validation
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
	 * @coversDefaultClass getRules
	 * @coversDefaultClass addRule
	 * @group              Validation
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
	 * @coversDefaultClass run
	 * @coversDefaultClass validateField
	 * @group              Validation
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
	 * @coversDefaultClass run
	 * @coversDefaultClass validateField
	 * @group              Validation
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
	 * @coversDefaultClass run
	 * @coversDefaultClass validateField
	 * @dataProvider       runMultipleFieldsData
	 * @group              Validation
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
	 * @coversDefaultClass getMessages
	 * @coversDefaultClass hasRun
	 * @coversDefaultClass reset
	 * @group              Validation
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
	 * @coversDefaultClass run
	 * @coversDefaultClass hasRun
	 * @group              Validation
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
	 * @coversDefaultClass getMessages
	 * @coversDefaultClass run
	 * @coversDefaultClass validateField
	 * @group              Validation
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

	/**
	 * @coversDefaultClass __call
	 * @expectedException  \Fuel\Validation\Exception\InvalidRule
	 * @group              Validation
	 */
	public function testMagicRuleInvalid()
	{
		$this->object->fakeTestRule();
	}

	/**
	 * @coversDefaultClass __call
	 * @group              Validation
	 */
	public function testAddMagicRule()
	{
		$this->object->addField('test')
			->required();

		$rules = $this->object->getRules('test');

		$this->assertInstanceOf(
			'\Fuel\Validation\Rule\Required',
			$rules[0]
		);
	}

	/**
	 * @coversDefaultClass __call
	 * @group              Validation
	 */
	public function testMagicChain()
	{
		$this->object
			->addField('first magic test')
				->number()
			->addField('test')
				->required()
				->matchField('first');

		$firstRules = $this->object->getRules('first magic test');

		// Make sure the first rule has been added correctly
		$this->assertEquals(
			1,
			count($firstRules)
		);

		$this->assertInstanceOf(
			'\Fuel\Validation\Rule\Number',
			$firstRules[0]
		);

		// Make sure the second field's rules are added correctly
		$testRules = $this->object->getRules('test');

		// Make sure there are two entries
		$this->assertEquals(
			2,
			count($testRules)
		);

		// And that the right rules have been added
		$this->assertInstanceOf(
			'\Fuel\Validation\Rule\Required',
			$testRules[0]
		);

		$this->assertInstanceOf(
			'\Fuel\Validation\Rule\MatchField',
			$testRules[1]
		);
	}

}
