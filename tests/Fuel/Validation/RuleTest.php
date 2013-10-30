<?php


namespace Fuel\Validation;


class RuleTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var Rule
	 */
	protected $object;

	protected function setUp()
	{
		$this->object = new Rule();
	}

	public function testTemp()
	{
		$this->assertTrue($this->object->returnTrue());
	}

}
