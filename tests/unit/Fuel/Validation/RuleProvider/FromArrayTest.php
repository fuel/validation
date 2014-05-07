<?php
/**
 * @package   Fuel\Validation
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Validation\RuleProvider;

use Fuel\Validation\Rule\MinLength;
use Fuel\Validation\Rule\Required;

/**
 * Tests for FromArray
 *
 * @package Fuel\Validation\RuleProvider
 * @author  Fuel Development Team
 *
 * @coversDefaultClass \Fuel\Validation\RuleProvider\FromArray
 */
class FromArrayTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var FromArray
	 */
	protected $object;

	protected function setUp()
	{
		$this->object = new FromArray;
	}

	/**
	 * @covers            ::populateValidator
	 * @covers            ::getData
	 * @expectedException \InvalidArgumentException
	 * @group             Validation
	 */
	public function testNoData()
	{
		$this->assertNull(
			$this->object->getData()
		);

		$validator = \Mockery::mock('Fuel\Validation\Validator');

		$this->object->populateValidator($validator);
	}

	/**
	 * @covers ::populateValidator
	 * @covers ::addFieldRule
	 * @covers ::addFieldRules
	 * @covers ::setData
	 * @group  Validation
	 */
	public function testPopulate()
	{
		$data = array(
			'test field' => array(
				'required',
				'minLength' => 12,
			),
		);

		$validator = \Mockery::mock('Fuel\Validation\Validator');

		// Ensure the field gets added
		$validator->shouldReceive('addField')->once()->with('test field', null);

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
		$this->object->populateValidator($validator);
	}

	/**
	 * @covers ::__construct
	 * @covers ::populateValidator
	 * @covers ::addFieldRule
	 * @covers ::addFieldRules
	 * @covers ::setData
	 * @group  Validation
	 */
	public function testLabel()
	{
		$object = new FromArray('label');

		$data = array(
			'test field' => array(
				'label' => 'Test field',
				'rules' => array(
					'required',
					'minLength' => 12,
				),
			),
		);

		$validator = \Mockery::mock('Fuel\Validation\Validator');

		// Ensure the field gets added
		$validator->shouldReceive('addField')->once()->with('test field', 'Test field');

		// Create some expected rules
		$requiredRule = new Required;
		$minLengthRule = new MinLength(12);

		// Make sure the mocked object knows that the rules need to be created
		$validator->shouldReceive('createRuleInstance')->with('required', null)->once()->andReturn($requiredRule);
		$validator->shouldReceive('createRuleInstance')->with('minLength', 12)->once()->andReturn($minLengthRule);

		// Finally make sure the addRule function is called
		$validator->shouldReceive('addRule')->with('test field', $requiredRule)->once();
		$validator->shouldReceive('addRule')->with('test field', $minLengthRule)->once();

		$object->setData($data);
		$object->populateValidator($validator);
	}

}
