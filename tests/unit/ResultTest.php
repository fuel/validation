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

use Codeception\TestCase\Test;

/**
 * Tests for Result
 *
 * @package Fuel\Validation
 * @author  Fuel Development Team
 *
 * @coversDefaultClass \Fuel\Validation\Result
 */
class ResultTest extends Test
{

	/**
	 * @var Result
	 */
	protected $object;

	protected function _before()
	{
		$this->object = new Result();
	}

	/**
	 * @covers ::setResult
	 * @covers ::isValid
	 * @group  Validation
	 */
	public function testSetGetResult()
	{
		$this->object->setResult(true);

		$this->assertTrue(
			$this->object->isValid()
		);
	}

	/**
	 * @covers ::getError
	 * @covers ::getErrors
	 * @covers ::setError
	 * @covers ::getFailedRules
	 * @group  Validation
	 */
	public function testSetGetErrors()
	{
		$this->object->setError('field1', 'msg1', 'one');
		$this->object->setError('field2', 'msg2', 'two');
		$this->object->setError('field3', 'msg3', 'three');

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

		$this->assertEquals(
			array(
				'field1' => 'msg1',
				'field2' => 'msg2',
				'field3' => 'msg3',
			),
			$this->object->getErrors()
		);

		$this->assertEquals(
			array(
				'field1' => 'one',
				'field2' => 'two',
				'field3' => 'three',
			),
			$this->object->getFailedRules()
		);
	}

	/**
	 * @covers             ::getError
	 * @covers             \Fuel\Validation\InvalidFieldException
	 * @expectedException  \Fuel\Validation\InvalidFieldException
	 * @group              Validation
	 */
	public function testGetInvalidError()
	{
		$this->object->getError('test');
	}

	/**
	 * @covers ::getValidated
	 * @covers ::setValidated
	 * @group  Validation
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
