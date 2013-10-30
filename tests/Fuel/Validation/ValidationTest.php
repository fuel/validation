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


class ValidationTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var Validation
	 */
	protected $object;

	protected function setUp()
	{
		$this->object = new Validation;
	}

	/**
	 * Tests getting and setting validation rules
	 *
	 * @covers Fuel\Validation\Validation::addRule
	 * @covers Fuel\Validation\Validation::getRule
	 * @group Validation
	 */
	public function testAddGetRule()
	{
		$ruleMock = \Mockery::mock('Fuel\Validation\RuleInterface');
		$name = 'test';

		$this->object->addRule($name, $ruleMock);

		$this->assertEquals(
			$ruleMock,
			$this->object->getRule($name)
		);
	}

	/**
	 * Tests getting an unknown rule
	 *
	 * @covers Fuel\Validation\Validation::getRule
	 * @expectedException \InvalidArgumentException
	 * @group Validation
	 */
	public function testGetInvalid()
	{
		$this->object->getRule('fake');
	}

	/**
	 * Tests checking for an unknown rule's existence
	 *
	 * @covers Fuel\Validation\Validation::isRule
	 * @group Validation
	 */
	public function testIsRuleInvalid()
	{
		$this->assertFalse(
			$this->object->isRule('fake')
		);
	}

	/**
	 * Tests checking for an unknown rule's existence
	 *
	 * @covers Fuel\Validation\Validation::isRule
	 * @covers Fuel\Validation\Validation::addRule
	 * @group Validation
	 */
	public function testIsRule()
	{
		$ruleMock = \Mockery::mock('Fuel\Validation\RuleInterface');
		$name = 'test';

		$this->object->addRule($name, $ruleMock);

		$this->assertTrue(
			$this->object->isRule($name)
		);
	}

	/**
	 * Tests removing a rule
	 *
	 * @covers Fuel\Validation\Validation::isRule
	 * @covers Fuel\Validation\Validation::addRule
	 * @covers Fuel\Validation\Validation::removeRule
	 * @group Validation
	 */
	public function testRemoveRule()
	{
		$ruleMock = \Mockery::mock('Fuel\Validation\RuleInterface');
		$name = 'test';

		$this->object->addRule($name, $ruleMock);
		$this->object->removeRule($name);

		$this->assertFalse(
			$this->object->isRule($name)
		);
	}

	/**
	 * Tests getting all rules when none are assigned
	 *
	 * @covers Fuel\Validation\Validation::getRules
	 * @group Validation
	 */
	public function testGetAllWithNone()
	{
		$this->assertEquals(
			array(),
			$this->object->getRules()
		);
	}

	/**
	 * Tests getting all rules when none are assigned
	 *
	 * @covers Fuel\Validation\Validation::getRules
	 * @group Validation
	 */
	public function testGetAllWithOne()
	{
		$ruleMock = \Mockery::mock('Fuel\Validation\RuleInterface');
		$name = 'test';

		$this->object->addRule($name, $ruleMock);

		$this->assertEquals(
			array($name => $ruleMock),
			$this->object->getRules()
		);
	}

}
