<?php

/**
 * Part of the FuelPHP framework.
 *
 * @package   Fuel\Validation
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */

namespace Fuel\Validation\Rule;

/**
 * Class EmailTest
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 */
class EmailTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var Email
	 */
	protected $object;

	protected function setUp()
	{
		$this->object = new Email;
	}

	/**
	 * @covers \Fuel\Validation\Rule\Email::__construct
	 * @covers \Fuel\Validation\Rule\Email::getMessage
	 * @group  Validation
	 */
	public function testGetMessage()
	{
		$this->assertEquals(
			'The field does not contain a valid email address.',
			$this->object->getMessage()
		);
	}

	/**
	 * @covers \Fuel\Validation\Rule\Email::getMessage
	 * @covers \Fuel\Validation\Rule\Email::setMessage
	 * @group  Validation
	 */
	public function testSetGetMessage()
	{
		$message = 'This is a message used for testing.';

		$this->object->setMessage($message);

		$this->assertEquals(
			$message,
			$this->object->getMessage()
		);
	}

	/**
	 * @covers       \Fuel\Validation\Rule\Email::validate
	 * @dataProvider validateProvider
	 * @group        Validation
	 */
	public function testValidate($emailValue, $expected)
	{
		$this->assertEquals(
			$expected,
			$this->object->validate($emailValue)
		);
	}

	/**
	 * Provides sample data for testing the email validation
	 *
	 * @return array
	 */
	public function validateProvider()
	{
		return array(
			array('admin@test.com', true),
			array('', false),
			array('@.com', false),
			array('test.email.user@test.domain.tld', true),
		);
	}

}
