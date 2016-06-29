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

	public function testSetGetResult()
	{
		$this->object->setResult(true);

		$this->assertTrue(
			$this->object->isValid()
		);
	}

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
	 * @expectedException \Fuel\Validation\InvalidFieldException
	 */
	public function testGetInvalidError()
	{
		$this->object->getError('test');
	}

	public function testSetGetValidated()
	{
		$this->object->setValidated('test');

		$this->assertEquals(
			array('test'),
			$this->object->getValidated()
		);
	}

	public function testMerge()
	{
		$result1 = new Result;
		$result1->setResult(false);
		$result1->setError('foo', 'foo failed', 'foocheck');
		$result1->setValidated('bar');

		$result2 = new Result;
		$result2->setResult(true);
		$result2->setError('baz', 'baz failed', 'bazcheck');
		$result2->setValidated('bat');

		$result1->merge($result2, 'sub.');

		$this->assertEquals(
			[
				'foo' => 'foo failed',
				'sub.baz' => 'baz failed',
			],
			$result1->getErrors()
		);

		$this->assertEquals(
			[
				'foo' => 'foocheck',
				'sub.baz' => 'bazcheck',
			],
			$result1->getFailedRules()
		);

		$this->assertEquals(
			[
				'bar',
				'sub.bat',
			],
			$result1->getValidated()
		);
	}

	public function testMergeWithStatus()
	{
		$result1 = new Result();
		$result1->setResult(true);

		// merging this should cause the $result1 to no longer be valid
		$result2 = new Result();
		$result2->setResult(false);

		$result1->merge($result2);
		$this->assertFalse(
			$result1->isValid()
		);
	}

}
