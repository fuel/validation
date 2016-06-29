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

class EnumMultiTest extends AbstractRuleTest
{

	/**
	 * {@inheritdocs}
	 */
	protected $message = 'One or more of the values given are not in the list of allowed values.';

	protected function _before()
	{
		$this->object = new EnumMulti;
	}

	/**
	 * {@inheritdocs}
	 */
	public function validateProvider()
	{
		return array(
			array(['foo'], true, ['foo']),
			array(['foo', 'bar'], true, ['foo', 'bar', 'baz', 'bat']),
			array(['foo', 'bar', 'wombat'], false, ['foo', 'bar', 'baz', 'bat']),
		);
	}

}
