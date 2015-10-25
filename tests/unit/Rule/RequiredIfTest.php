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

class RequiredIfTest extends AbstractRequiredTest
{

	protected function _before()
	{
		$this->object = new RequiredIf('field');
	}

	/**
	 * {@inheritdocs}
	 */
	public function validateProvider()
	{
		return array(
			array('value', null, false, array('field' => 'value')),
			array('', null, true, null),
			array('value', null, false, array('field' => 'othervalue')),
			array('value', null, true, array('field' => '')),
		);
	}

}
