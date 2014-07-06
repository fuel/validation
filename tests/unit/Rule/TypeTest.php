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
 * Defines tests for Type
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @coversDefaultClass  \Fuel\Validation\Rule\Type
 */
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
	 * Provides sample data for testing the email validation
	 *
	 * @return array
	 */
	public function validateProvider()
	{
		return array(
			array('admin@test.com', true, 'string'),
			array('admin@test.com', false, 'numeric'),
			array('admin@test.com', false, 'stdClass'),
			array('admin@test.com', true, array('numeric', 'string')),
			array(1, true, 'numeric'),
			array(1, true, 'int'),
			array(1, false, 'string'),
			array(1, false, 'stdClass'),
			array(1, true, array('string', 'int')),
			array(1, false, null),
			array(new \stdClass(), true, 'stdClass'),
			array(new \stdClass(), false, 'string'),
		);
	}

}
