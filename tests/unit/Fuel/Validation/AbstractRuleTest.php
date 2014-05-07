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

require_once(__DIR__.'/../../DummyAbstractRule.php');

/**
 * Tests for AbstractRule
 *
 * @package Fuel\Validation
 * @author  Fuel Development Team
 *
 * @coversDefaultClass \Fuel\Validation\AbstractRule
 */
class AbstractRuleTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var AbstractRule
	 */
	protected $object;

	protected function setUp()
	{
		$this->object = new \DummyAbstractRule;
	}

	/**
	 * @covers ::__construct
	 * @group  Validation
	 */
	public function testConstruct()
	{
		$params = 'foobar';
		$message = 'test message';

		$abstractRule = new \DummyAbstractRule($params, $message);

		$this->assertEquals(
			$params,
			$abstractRule->getParameter()
		);

		$this->assertEquals(
			$message,
			$abstractRule->getMessage()
		);
	}

	/**
	 * @covers ::getMessage
	 * @group  Validation
	 */
	public function testDefaultMessage()
	{
		$this->assertEquals(
			'',
			$this->object->getMessage()
		);
	}

	/**
	 * @covers ::getMessage
	 * @covers ::setMessage
	 * @group  Validation
	 */
	public function testGetSetMessage()
	{
		$message = 'This is a test message';

		$this->object->setMessage($message);

		$this->assertEquals(
			$message,
			$this->object->getMessage()
		);
	}

	/**
	 * @covers ::getParameter
	 * @group  Validation
	 */
	public function testGetParam()
	{
		$this->assertNull(
			$this->object->getParameter()
		);
	}

	/**
	 * @covers        ::getParameter
	 * @covers        ::setParameter
	 * @dataProvider  paramDataProvider
	 * @group         Validation
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

	/**
	 * @covers ::getMessageParameters
	 * @group  Validation
	 */
	public function testGetDefaultMessageParams()
	{
		$this->assertEquals(
			array(),
			$this->object->getMessageParameters()
		);
	}

}
