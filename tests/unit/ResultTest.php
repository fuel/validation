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

}
