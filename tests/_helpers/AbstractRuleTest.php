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

use Codeception\TestCase\Test;

abstract class AbstractRuleTest extends Test
{

	/**
	 * @var \Fuel\Validation\AbstractRule
	 */
	protected $object;

	/**
	 * @var string
	 */
	protected $message;

	public function testGetMessage()
	{
		$this->assertEquals(
			$this->message,
			$this->object->getMessage()
		);
	}

	/**
	 * @dataProvider validateProvider
	 */
	public function testValidate()
	{
		if (func_num_args() > 2)
		{
			$this->object->setParameter(func_get_arg(2));
		}

		list($value, $expected) = func_get_args();

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
