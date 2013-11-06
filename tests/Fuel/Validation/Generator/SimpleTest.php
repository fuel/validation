<?php
/**
 * @package   Fuel\Validation
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Validation\Generator;

use Fuel\Validation\Rule\MinLength;
use Fuel\Validation\Rule\Required;

/**
 * Tests for Simple
 *
 * @package Fuel\Validation\Generator
 * @author  Fuel Development Team
 *
 * @covers \Fuel\Validation\Generator\Simple
 */
class SimpleTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var Simple
	 */
	protected $object;

	protected function setUp()
	{
		$this->object = new Simple;
	}

	/**
	 * @coversDefaultClass populateValidation
	 * @coversDefaultClass getData
	 * @expectedException  \InvalidArgumentException
	 * @group              Validation
	 */
	public function testNoData()
	{
		$this->assertNull(
			$this->object->getData()
		);

		$validator = \Mockery::mock('\Fuel\Validation\Validator');

		$this->object->populateValidation($validator);
	}

	public function testPopulate()
	{
		$data = array(
			'test field' => array(
				'required',
				'minLength' => 12,
			),
		);

		$validator = \Mockery::mock('\Fuel\Validation\Validator');

		// Ensure the field gets added
		$validator->shouldReceive('addField')->once()->with('test field');

		// Create some expected rules
		$requiredRule = new Required;
		$minLengthRule = new MinLength(12);

		// Make sure the mocked object knows that the rules need to be created
		$validator->shouldReceive('createRuleInstance')->with('required', null)->once()->andReturn($requiredRule);
		$validator->shouldReceive('createRuleInstance')->with('minLength', 12)->once()->andReturn($minLengthRule);

		// Finally make sure the addRule function is called
		$validator->shouldReceive('addRule')->with('test field', $requiredRule)->once();
		$validator->shouldReceive('addRule')->with('test field', $minLengthRule)->once();

		$this->object->setData($data);
		$this->object->populateValidation($validator);
	}

}
