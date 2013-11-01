<?php

/**
 * Part of the FuelPHP framework.
 *
 * @package   Fuel\Validation
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */

namespace Fuel\Validation\Exception;


class InvalidFieldTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @covers \Fuel\Validation\Exception\InvalidField::__construct
	 * @group  Validation
	 */
	public function testDefaultConstructor()
	{
		$object = new InvalidField();

		$this->assertEquals(
			'VAL-001: The specified field is not known.',
			$object->getMessage()
		);
	}

	/**
	 * @covers \Fuel\Validation\Exception\InvalidField::__construct
	 * @group  Validation
	 */
	public function testConstructorWithField()
	{
		$fieldName = 'myCustomField';

		$object = new InvalidField($fieldName);

		$this->assertEquals(
			'VAL-002: The field ['.$fieldName.'] is not known.',
			$object->getMessage()
		);
	}

}
