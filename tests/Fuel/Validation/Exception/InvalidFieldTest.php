<?php
/**
 * @package   Fuel\Validation
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Validation\Exception;

/**
 * Tests for InvalidField exception
 *
 * @package Fuel\Validation\Exception
 * @author  Fuel Development Team
 *
 * @covers  \Fuel\Validation\Exception\InvalidField
 */
class InvalidFieldTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @coversDefaultClass __construct
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
	 * @coversDefaultClass __construct
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
