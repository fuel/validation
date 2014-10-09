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

class RequiredWithTest extends RequiredTest
{

	protected function _before()
	{
		$this->object = new RequiredWith('field');
	}

	/**
	 * {@inheritdocs}
	 */
	public function validateProvider()
	{
		return array(
			array('admin@test.com', null, false, array('field' => '')),
			array('admin@test.com', null, true, null),
			array('', null, true, null),
			array('', null, false, array('field' => '')),
		);
	}

}
