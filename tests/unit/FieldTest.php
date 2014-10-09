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

use CodeCeption\TestCase\Test;
use Mockery;

class FieldTest extends Test
{

	/**
	 * @var Field
	 */
	protected $object;

	protected function _before()
	{
		$this->object = new Field;
	}

	public function testSetGetName()
	{
		$name = 'fieldName';

		$this->object->setName($name);

		$this->assertEquals(
			$name,
			$this->object->getName()
		);
	}

	public function testSetGetLabel()
	{
		$name = 'Joe';

		$this->object->setLabel($name);

		$this->assertEquals(
			$name,
			$this->object->getLabel()
		);
	}

	public function testAddGetRules()
	{
		$rule = Mockery::mock('Fuel\Validation\RuleInterface');

		$this->object->addRule($rule);

		$this->assertEquals(
			array($rule),
			$this->object->getRules()
		);
	}

	public function testGetNullLabel()
	{
		$name = 'test';

		$this->object->setName($name);

		$this->assertEquals(
			$name,
			$this->object->getLabel()
		);
	}

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
