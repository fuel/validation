<?php

/**
 * Part of the FuelPHP framework.
 *
 * @package   Fuel\Validation
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */

namespace Fuel\Validation\Rule;

/**
 * Class MaxLengthTest
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @covers  \Fuel\Validation\Rule\MaxLength
 */
class MaxLengthTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var MaxLength
     */
    protected $object;

    protected function setUp()
    {
        $this->object = new MaxLength;
    }

    /**
     * @coversDefaultClass __construct
     * @coversDefaultClass getMessage
     * @group              Validation
     */
    public function testGetMessage()
    {
        $this->assertEquals(
            'The field is longer than the allowed maximum length.',
            $this->object->getMessage()
        );
    }

    /**
     * @coversDefaultClass validate
     * @dataProvider       validateProvider
     * @group              Validation
     */
    public function testValidate($stringValue, $maxLength, $expected)
    {
        $this->object->setParameter($maxLength);
        $this->assertEquals(
            $expected,
            $this->object->validate($stringValue)
        );
    }

    /**
     * Provides sample data for testing the maximum length validation
     *
     * @return array
     */
    public function validateProvider()
    {
        require_once('/tests/ClassWithToString.php');
        $classWithToString = new ClassWithToString();

        return array(
            array('hello', 1, true),
            array('', 1, false),
            array('12345', 5, true),
            array('test.email.user@test.domain.tld', 500, false),
            array('ä', 1, true),
            array('', 0, true),
            array('', -1, true),
            array('z', 0, true),
            array(new \stdClass(), 100, false),
            array(new \stdClass(), null, false),
            array($classWithToString, 1, true),
            array($classWithToString, null, true),
            array($classWithToString, 100000, false),
            array(function(){ return false; }, null, false),
            array('', null, true),
            array(null, 1, false),
            array(null, null, true)
        );
    }
    /**
     * @coversDefaultClass getMessage
     * @coversDefaultClass __construct
     * @group              Validation
     */
    public function testCustomMessageOnConstruct()
    {
        $message = 'foobarbazbat';

        $object = new MaxLength(null, $message);

        $this->assertEquals(
            $message,
            $object->getMessage()
        );
    }

}
