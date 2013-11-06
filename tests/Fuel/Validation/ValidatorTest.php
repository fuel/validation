<?php
/**
 * @package   Fuel\Validation
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 * @link      http://fuelphp.com
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
 * @covers  \Fuel\Validation\Validator
 */
class ValidatorTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var Validator
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
		$this->object = new Validator;

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
			)->isValid()
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
			)->isValid()
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
			$this->object->run($data)->isValid()
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

	/**
	 * @coversDefaultClass addCustomRule
	 * @coversDefaultClass createRuleInstance
	 * @group              Validation
	 */
	public function testAddCustomRule()
	{
		$this->object->addCustomRule('testRule', '\Fuel\Validation\FakeRule');

		$this->assertInstanceOf(
			'\Fuel\Validation\FakeRule',
			$this->object->createRuleInstance('testRule')
		);

		// Check that our magic methods are working
	}

	/**
	 * @coversDefaultClass addCustomRule
	 * @coversDefaultClass createRuleInstance
	 * @group              Validation
	 */
	public function testAddCoreRuleOverride()
	{
		$this->object->addCustomRule('required', '\Fuel\Validation\FakeRule');

		$this->assertInstanceOf(
			'\Fuel\Validation\FakeRule',
			$this->object->createRuleInstance('required')
		);
	}

}

/**
 * Fake validation rule to test adding custom rules
 *
 * @package Fuel\Validation
 * @author  Fuel Development Team
 */
class FakeRule extends AbstractRule
{

	/**
	 * Will always return the $value
	 */
	public function validate($value, $field = null, &$allFields = null)
	{
		return $value;
	}
}
