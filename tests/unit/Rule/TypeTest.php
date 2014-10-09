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

class TypeTest extends AbstractRuleTest
{

	/**
	 * {@inheritdocs}
	 */
	protected $message = 'The field is not one of the given type(s).';

	protected function _before()
	{
		$this->object = new Type;
	}

	/**
	 * {@inheritdocs}
	 */
	public function validateProvider()
	{
		return array(
			0 => array('admin@test.com', true, 'string'),
			1 => array('admin@test.com', false, 'numeric'),
			2 => array('admin@test.com', false, 'stdClass'),
			3 => array('admin@test.com', true, array('numeric', 'string')),
			4 => array(1, true, 'numeric'),
			5 => array(1, true, 'int'),
			6 => array(1, false, 'string'),
			7 => array(1, false, 'stdClass'),
			8 => array(1, true, array('string', 'int')),
			9 => array(1, false, null),
			10 => array(new \stdClass(), true, 'stdClass'),
			11 => array(new \stdClass(), false, 'string'),
		);
	}

}
