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

use Mockery;

class ValidatorTest extends AbstractRuleTest
{

	/**
	 * {@inheritdocs}
	 */
	protected $message = 'The child model is invalid.';

	protected function _before()
	{
		$this->object = new Validator();
	}

	public function testValidate()
	{
		$mock = Mockery::mock('Fuel\Validation\ValidatableInterface');
		$mock->shouldReceive('run')
			->with('admin@test.com')
			->once()
			->andReturn(true);

		$this->object->setParameter($mock);
		$this->assertEquals(
			true,
			$this->object->validate('admin@test.com')
		);
	}

	/**
	 * {@inheritdocs}
	 */
	public function validateProvider()
	{
		return [];
	}

	/**
	 * @expectedException \InvalidArgumentException
	 * @expectedExceptionMessage VAL-009: Provided parameter does not implement ValidatableInterface
	 */
	public function testSetInvalidParameter()
	{
		$this->object->setParameter('foo');
	}

}
