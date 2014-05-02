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
 * @covers  Fuel\Validation\Rule\Email
 */
class EmailTest extends AbstractTest
{

	protected function setUp()
	{
		$this->object = new Email;
		$this->message = 'The field does not contain a valid email address.';
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
