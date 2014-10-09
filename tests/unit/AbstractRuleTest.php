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
use DummyAbstractRule;

class AbstractRuleTest extends Test
{

	/**
	 * @var AbstractRule
	 */
	protected $object;

	protected function _before()
	{
		$this->object = new DummyAbstractRule;
	}

	public function testConstruct()
	{
		$params = 'foobar';
		$message = 'test message';

		$abstractRule = new DummyAbstractRule($params, $message);

		$this->assertEquals(
			$params,
			$abstractRule->getParameter()
		);

		$this->assertEquals(
			$message,
			$abstractRule->getMessage()
		);
	}

	public function testDefaultMessage()
	{
		$this->assertEquals(
			'',
			$this->object->getMessage()
		);
	}

	public function testGetSetMessage()
	{
		$message = 'This is a test message';

		$this->object->setMessage($message);

		$this->assertEquals(
			$message,
			$this->object->getMessage()
		);
	}

	public function testGetParam()
	{
		$this->assertNull(
			$this->object->getParameter()
		);
	}

	/**
	 * @dataProvider paramDataProvider
	 */
	public function testSetGetParam($param)
	{
		$this->object->setParameter($param);

		$this->assertEquals(
			$param,
			$this->object->getParameter()
		);
	}

	/**
	 * Returns various formats of data for testing rule parameter getting/setting
	 *
	 * @return array
	 */
	public function paramDataProvider()
	{
		return array(
			array('Test'),
			array(123),
			array(new \stdClass()),
		);
	}

	public function testGetDefaultMessageParams()
	{
		$this->assertEquals(
			array(),
			$this->object->getMessageParameters()
		);
	}

}
