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
 * Defines tests for Email
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @covers  \Fuel\Validation\Rule\Email
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
	 * @coversDefaultClass __construct
	 * @coversDefaultClass getMessage
	 * @group              Validation
	 */
	public function testGetMessage()
	{
		$this->assertEquals(
			'The field does not contain a valid email address.',
			$this->object->getMessage()
		);
	}

	/**
	 * @coversDefaultClass getMessage
	 * @coversDefaultClass setMessage
	 * @group              Validation
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
	 * @coversDefaultClass validate
	 * @dataProvider       validateProvider
	 * @group              Validation
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

	/**
	 * @coversDefaultClass getMessage
	 * @coversDefaultClass __construct
	 * @group              Validation
	 */
	public function testCustomMessageOnConstruct()
	{
		$message = 'foobarbazbat';

		$object = new Email(null, $message);

		$this->assertEquals(
			$message,
			$object->getMessage()
		);
	}

}
