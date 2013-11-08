<?php
/**
 * @package   Fuel\Validation
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Validation;

/**
 * Tests for Result
 *
 * @package Fuel\Validation
 * @author  Fuel Development Team
 *
 * @covers Fuel\Validation\Result
 */
class ResultTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var Result
	 */
	protected $object;

	protected function setUp()
	{
		$this->object = new Result();
	}

	/**
	 * @coversDefaultClass setResult
	 * @coversDefaultClass isValid
	 * @group              Validation
	 */
	public function testSetGetResult()
	{
		$this->object->setResult(true);

		$this->assertTrue(
			$this->object->isValid()
		);
	}

	/**
	 * @coversDefaultClass getError
	 * @coversDefaultClass getErrors
	 * @coversDefaultClass setError
	 * @group              Validation
	 */
	public function testSetGetErrors()
	{
		$this->object->setError('field1', 'msg1');
		$this->object->setError('field2', 'msg2');
		$this->object->setError('field3', 'msg3');

		$this->assertEquals(
			'msg1',
			$this->object->getError('field1')
		);

		$this->assertEquals(
			'msg2',
			$this->object->getError('field2')
		);

		$this->assertEquals(
			'msg3',
			$this->object->getError('field3')
		);

		$expected = array(
			'field1' => 'msg1',
			'field2' => 'msg2',
			'field3' => 'msg3',
		);

		$this->assertEquals(
			$expected,
			$this->object->getErrors()
		);
	}

	/**
	 * @coversDefaultClass getError
	 * @expectedException  Fuel\Validation\InvalidFieldException
	 * @group              Validation
	 */
	public function testGetInvalidError()
	{
		$this->object->getError('test');
	}

	/**
	 * @coversDefaultClass getValidated
	 * @coversDefaultClass setValidated
	 * @group              Validation
	 */
	public function testSetGetValidated()
	{
		$this->object->setValidated('test');

		$this->assertEquals(
			array('test'),
			$this->object->getValidated()
		);
	}

}
