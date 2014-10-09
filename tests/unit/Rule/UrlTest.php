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

class UrlTest extends AbstractRuleTest
{

	/**
	 * {@inheritdocs}
	 */
	protected $message = 'The field is not a valid url.';

	protected function _before()
	{
		$this->object = new Url;
	}

	/**
	 * {@inheritdocs}
	 */
	public function validateProvider()
	{
		return array(
			array('', false),
			array(1, false),
			array(true, false),
			array(new \stdClass, false),
			array('512.123.1254.34234', false),
			array('http://fuelphp.com', true),
			array('http://fuelphp', true),
			array('fuelphp.com', false),
			array('sftp://user:password@fuelphp.com', true),
			array('http://192.168.0.1', true),
			array('ftp://FE80::0202:B3FF:FE1E:8329', true),
		);
	}

}
