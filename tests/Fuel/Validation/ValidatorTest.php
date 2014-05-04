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
 * @coversDefaultClass \Fuel\Validation\Validator
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
	 * @covers ::addField
	 * @group  Validation
	 */
	public function testAddField()
	{
		$field = 'test field';

		$this->object->addField($field);

		$this->assertInstanceOf(
			'Fuel\Validation\FieldInterface',
			$this->object->getField($field)
		);
	}

	/**
	 * @covers ::run
	 * @covers ::validateField
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
			)->isValid()
		);
	}

	/**
	 * @covers ::runField
	 * @covers ::validateField
	 * @group  Validation
	 */
	public function testRunField()
	{
		$fieldName = 'email';

		$this->object->addRule($fieldName, new Email());

		$this->assertTrue(
			$this->object->runField(
				$fieldName,
				array(
					$fieldName => 'user@domain.example',
				)
			)->isValid()
		);

		$this->assertFalse(
			$this->object->runField(
				$fieldName,
				array(
					$fieldName => 'example',
				)
			)->isValid()
		);
	}

	/**
	 * @covers ::run
	 * @covers ::validateField
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
			)->isValid()
		);
	}

	/**
	 * @covers ::runField
	 * @covers ::validateField
	 * @group  Validation
	 */
	public function testRunFieldFailure()
	{
		$this->assertFalse(
			$this->object->runField(
				'email',
				array()
			)->isValid()
		);
	}

	/**
	 * @covers ::      run
	 * @covers ::      validateField
	 * @dataProvider runMultipleFieldsData
	 * @group        Validation
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
	 * @covers ::           __call
	 * @expectedException \Fuel\Validation\InvalidRuleException
	 * @group             Validation
	 */
	public function testMagicRuleInvalid()
	{
		$this->object->fakeTestRule();
	}

	/**
	 * @covers ::__call
	 * @group  Validation
	 */
	public function testAddMagicRule()
	{
		$this->object->addField('test')
			->required();

		$rules = $this->object->getField('test')->getRules();

		$this->assertInstanceOf(
			'Fuel\Validation\Rule\Required',
			$rules[0]
		);
	}

	/**
	 * @covers ::setMessage
	 * @group  Validation
	 */
	public function testSetMessage()
	{
		$rule = new Number;

		$this->object->addRule('test', $rule)
			->setMessage('injected message');

		$this->assertEquals(
			'injected message',
			$rule->getMessage()
		);
	}

	/**
	 * @covers ::           setMessage
	 * @group             Validation
	 * @expectedException \LogicException
	 */
	public function testSetMessageException()
	{
		$this->object->setMessage('injected message');
	}

	/**
	 * @covers ::__call
	 * @group  Validation
	 */
	public function testMagicChain()
	{
		$this->object
			->addField('first magic test')
				->number()
			->addField('test')
				->required()
				->matchField('first');

		$firstRules = $this->object->getFieldRules('first magic test');

		// Make sure the first rule has been added correctly
		$this->assertEquals(
			1,
			count($firstRules)
		);

		$this->assertInstanceOf(
			'Fuel\Validation\Rule\Number',
			$firstRules[0]
		);

		// Make sure the second field's rules are added correctly
		$testRules = $this->object->getFieldRules('test');

		// Make sure there are two entries
		$this->assertEquals(
			2,
			count($testRules)
		);

		// And that the right rules have been added
		$this->assertInstanceOf(
			'Fuel\Validation\Rule\Required',
			$testRules[0]
		);

		$this->assertInstanceOf(
			'Fuel\Validation\Rule\MatchField',
			$testRules[1]
		);
	}

	/**
	 * @covers ::           addField
	 * @expectedException \InvalidArgumentException
	 * @group             Validation
	 */
	public function testAddInvalidField()
	{
		$this->object->addField(new \stdClass());
	}

	/**
	 * @covers ::getFieldRules
	 * @group  Validation
	 */
	public function testGetInvalidFieldRules()
	{
		$this->assertEquals(
			array(),
			$this->object->getFieldRules('fake test field')
		);
	}

	/**
	 * @covers ::addCustomRule
	 * @covers ::createRuleInstance
	 * @group  Validation
	 */
	public function testAddCustomRule()
	{
		$this->object->addCustomRule('testRule', '\DummyAbstractRule');

		$this->assertInstanceOf(
			'\DummyAbstractRule',
			$this->object->createRuleInstance('testRule')
		);

		// Check that our magic methods are working
	}

	/**
	 * @covers ::addCustomRule
	 * @covers ::createRuleInstance
	 * @group  Validation
	 */
	public function testAddCoreRuleOverride()
	{
		$this->object->addCustomRule('required', '\DummyAbstractRule');

		$this->assertInstanceOf(
			'\DummyAbstractRule',
			$this->object->createRuleInstance('required')
		);
	}

	/**
	 * @covers ::setMessage
	 * @group  Validation
	 */
	public function testMessageReplacement()
	{
		$this->object->addField('test', 'My Field')
			->required()
			->setMessage('{label} with the data from {name} is required');

		$result = $this->object->run(array('test' => null));

		$this->assertEquals(
			'My Field with the data from test is required',
			$result->getError('test')
		);
	}

	/**
	 * @covers ::setGlobalMessage
	 * @covers ::getGlobalMessage
	 * @covers ::removeGlobalMessage
	 * @group  Validation
	 */
	public function testGetSetGlobalMessage()
	{
		$message = 'Test message';
		$ruleName = 'test';

		$this->assertNull(
			$this->object->getGlobalMessage($ruleName)
		);

		$this->object->setGlobalMessage($ruleName, $message);

		$this->assertEquals(
			$message,
			$this->object->getGlobalMessage($ruleName)
		);

		$this->object->setGlobalMessage($ruleName, null);

		$this->assertNull(
			$this->object->getGlobalMessage($ruleName)
		);
	}

	/**
	 * @covers ::setGlobalMessage
	 * @covers ::createRuleInstance
	 * @group  Validation
	 */
	public function testCreateRuleInstanceWithGlobalMessage()
	{
		$message = 'Test message';
		$ruleName = 'test';
		$class = '\DummyAbstractRule';

		$this->object->setGlobalMessage($ruleName, $message);

		$this->object->addCustomRule($ruleName, $class);

		$insatnce = $this->object->createRuleInstance($ruleName);

		$this->assertEquals(
			$message,
			$insatnce->getMessage()
		);
	}

}
