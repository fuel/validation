<?php
/**
 * @package   Fuel\Validation
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2016 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Validation\Rule;

class EnumTest extends AbstractRuleTest
{

	/**
	 * {@inheritdocs}
	 */
	protected $message = 'The value given is not in the list of allowed values.';

	protected function _before()
	{
		$this->object = new Enum;
	}

	/**
	 * {@inheritdocs}
	 */
	public function validateProvider()
	{
		return array(
			array('foo', true, 'foo'),
			array('bar', true, ['foo', 'bar', 'baz']),
			array('bar', false, 'foo'),
			array('bar', false, ['foo', 'baz']),
		);
	}

}
