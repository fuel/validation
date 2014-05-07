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

/**
 * Tests for Field
 *
 * @package Fuel\Validation
 * @author  Fuel Development Team
 *
 * @coversDefaultClass \Fuel\Validation\Field
 */
class FieldTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var Field
	 */
	protected $object;

	public function setUp()
	{
		$this->object = new Field;
	}

	/**
	 * @covers ::setName
	 * @covers ::getName
	 * @group  Validation
	 */
	public function testSetGetName()
	{
		$name = 'fieldName';

		$this->object->setName($name);

		$this->assertEquals(
			$name,
			$this->object->getName()
		);
	}

	/**
	 * @covers ::getLabel
	 * @covers ::setLabel
	 * @group  Validation
	 */
	public function testSetGetLabel()
	{
		$name = 'Joe';

		$this->object->setLabel($name);

		$this->assertEquals(
			$name,
			$this->object->getLabel()
		);
	}

	/**
	 * @covers ::addRule
	 * @covers ::getRules
	 * @group  Validation
	 */
	public function testAddGetRules()
	{
		$rule = \Mockery::mock('Fuel\Validation\RuleInterface');

		$this->object->addRule($rule);

		$this->assertEquals(
			array($rule),
			$this->object->getRules()
		);
	}

	/**
	 * @covers ::getLabel
	 * @group  Validation
	 */
	public function testGetNullLabel()
	{
		$name = 'test';

		$this->object->setName($name);

		$this->assertEquals(
			$name,
			$this->object->getLabel()
		);
	}

	/**
	 * @covers ::__construct
	 * @group  Validation
	 */
	public function testConstruct()
	{
		$name = 'test';
		$label = 'My Awesome Test';

		$object = new Field($name, $label);

		$this->assertEquals(
			$name,
			$object->getName()
		);

		$this->assertEquals(
			$label,
			$object->getLabel()
		);
	}

}
