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

class IpTest extends AbstractRuleTest
{

	/**
	 * {@inheritdocs}
	 */
	protected $message = 'The field is not a valid IP address.';

	protected function _before()
	{
		$this->object = new Ip;
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
			array('192.168.0.1', true),
			array('FE80::0202:B3FF:FE1E:8329', true),
			array('FE80:0000:0000:0000:0202:B3FF:FE1E:8329', true),
			array('ZZZZ::ZZZZ:ZZZZ', false),
			array('ZZZZ:ZZZZ', false),
			array('ZZZZ::ZZZZ:ZZZZ:ZZZZ:ZZZZ', false),
			array('ZZZZ:ZZZZ:ZZZZ:ZZZZ:ZZZZ:ZZZZ:ZZZZ:ZZZ', false),
		);
	}

}
