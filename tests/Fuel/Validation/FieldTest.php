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
 * @covers Fuel\Validation\Field
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
	 * @coversDefaultClass setName
	 * @coversDefaultClass getName
	 * @group              Validation
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
	 * @coversDefaultClass setFriendlyName
	 * @coversDefaultClass getFriendlyName
	 * @group              Validation
	 */
	public function testSetGetFriendlyName()
	{
		$name = 'Joe';

		$this->object->setFriendlyName($name);

		$this->assertEquals(
			$name,
			$this->object->getFriendlyName()
		);
	}

	/**
	 * @coversDefaultClass addRule
	 * @coversDefaultClass getRules
	 * @group              Validation
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
	 * @coversDefaultClass getFriendlyName
	 * @group              Validation
	 */
	public function testGetNullFriendlyName()
	{
		$name = 'test';

		$this->object->setName($name);

		$this->assertEquals(
			$name,
			$this->object->getFriendlyName()
		);
	}

	/**
	 * @coversDefaultClass __construct
	 * @group              Validation
	 */
	public function testConstruct()
	{
		$name = 'test';
		$friendlyName = 'My Awesome Test';

		$object = new Field($name, $friendlyName);

		$this->assertEquals(
			$name,
			$object->getName()
		);

		$this->assertEquals(
			$friendlyName,
			$object->getFriendlyName()
		);
	}

}
