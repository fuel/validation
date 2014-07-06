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

/**
 * Defines tests for Email
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @coversDefaultClass  \Fuel\Validation\Rule\Date
 */
class DateTest extends AbstractRuleTest
{

	/**
	 * {@inheritdocs}
	 */
	protected $message = 'The field does not contain a valid date.';

	protected function _before()
	{
		$this->object = new Date;
	}

	/**
	 * @covers       ::validate
	 * @dataProvider validateProvider
	 * @group        Validation
	 */
	public function testValidate()
	{
		list($dateValue, $format, $strict, $expected) = func_get_args();

		$param = array('format' => $format, 'strict' => $strict);

		parent::testValidate($dateValue, $expected, $param);
	}

	/**
	 * {@inheritdocs}
	 */
	public function validateProvider()
	{
		return array(
			array('admin@test.com', 'Y/m/d', true, false),
			array('admin@test.com', null, true, false),
			array('admin@test.com', 'Y/m/d', false, false),
			array('admin@test.com', null, false, false),
			array('10/41/10', 'Y/m/d', true, false),
			array('10/41/10', null, true, false),
			array('10/41/10', 'Y/m/d', false, false),
			array('10/41/10', null, false, false),
			array('10/10/10', 'Y/m/d', true, true),
			array('10/10/10', null, true, false),
			array('10/10/10', 'Y/m/d', false, true),
			array('10/10/10', null, false, false),
			array('2012/10/10', 'Y/m/d', true, true),
			array('2012/10/10', null, true, false),
			array('2012/10/10', 'Y/m/d', false, true),
			array('2012/10/10', 'Y.m.d', false, false),
			array('2012.10.10', 'Y.m.d', false, true),
			array('2012/10/10', null, false, false),
			array(new \stdClass(), "Y/m.d", false, false),
			array(new \stdClass(), null, true, false),
			array(new \ClassWithToString("1990/12/12"), "Y/m/d", true, true),
			array(new \ClassWithToString(), "D/m/Y", true, false),
			array(new \ClassWithToString(), null, true, false),
			array(new \ClassWithToString(), 100000, true, false),
			array(function(){ return "10/10/10"; }, "d/m/y", true, false),
		);
	}

	/**
	 * @covers ::getMessageParameters
	 * @group  Validation
	 */
	public function testGetMessageParams()
	{
		$parameter = 'YYYY/MM/DD';

		$this->object->setParameter(array('format' => $parameter));

		$this->assertEquals(
			array('format' => $parameter),
			$this->object->getMessageParameters()
		);
	}

}
