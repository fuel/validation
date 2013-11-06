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
 * Tests for InvalidField exception
 *
 * @package Fuel\Validation
 * @author  Fuel Development Team
 *
 * @covers  \Fuel\Validation\InvalidFieldException
 */
class InvalidFieldExceptionTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @coversDefaultClass __construct
	 * @group  Validation
	 */
	public function testDefaultConstructor()
	{
		$object = new InvalidFieldException();

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

		$object = new InvalidFieldException($fieldName);

		$this->assertEquals(
			'VAL-002: The field ['.$fieldName.'] is not known.',
			$object->getMessage()
		);
	}

}
