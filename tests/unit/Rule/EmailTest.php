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

class EmailTest extends AbstractRuleTest
{

	/**
	 * {@inheritdocs}
	 */
	protected $message = 'The field does not contain a valid email address.';

	protected function _before()
	{
		$this->object = new Email;
	}

	/**
	 * {@inheritdocs}
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
