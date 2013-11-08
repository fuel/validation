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
 * Tests for InvalidRule exception
 *
 * @package Fuel\Validation
 * @author  Fuel Development Team
 *
 * @covers  Fuel\Validation\InvalidRuleException
 */
class InvalidRuleExceptionTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @coversDefaultClass __construct
	 * @group  Validation
	 */
	public function testDefaultConstructor()
	{
		$object = new InvalidRuleException();

		$this->assertEquals(
			'VAL-003: The specified rule is not known.',
			$object->getMessage()
		);
	}

	/**
	 * @coversDefaultClass __construct
	 * @group  Validation
	 */
	public function testConstructorWithField()
	{
		$ruleName = 'myCustomField';

		$object = new InvalidRuleException($ruleName);

		$this->assertEquals(
			'VAL-004: The rule ['.$ruleName.'] is not known.',
			$object->getMessage()
		);
	}

}
