<?php
/**
 * @package   Fuel\Validation
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Validation\Rule;

/**
 * Defines tests for Rules
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 */
abstract class AbstractTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var AbstractRule
	 */
	protected $object;

	/**
	 * @var string
	 */
	protected $message;

	/**
	 * @coversDefaultClass __construct
	 * @coversDefaultClass getMessage
	 * @group              Validation
	 */
	public function testGetMessage()
	{
		$this->assertEquals(
			$this->message,
			$this->object->getMessage()
		);
	}

	/**
	 * @coversDefaultClass validate
	 * @dataProvider       validateProvider
	 * @group              Validation
	 */
	public function testValidate($value, $expected)
	{
		if (func_num_args() > 2)
		{
			$this->object->setParameter(func_get_arg(2));
		}

		$this->assertEquals(
			$expected,
			$this->object->validate($value)
		);
	}

	/**
	 * Provides sample data for testing
	 *
	 * @return array
	 */
	abstract public function validateProvider();

}
