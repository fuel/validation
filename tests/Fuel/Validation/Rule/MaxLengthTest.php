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

require_once(__DIR__.'/../../../ClassWithToString.php');

/**
 * Tests the MaxLength class.
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

        return array(
            array('hello', 1, false),
            array('', 1, true),
            array('12345', 5, true),
            array('test.email.user@test.domain.tld', 500, true),
            array('b', 1, true),
            array('ä', 1, true),
            array('', 0, true),
            array('', -1, false),
            array('z', 0, false),
            array(new \stdClass(), 100, true),
            array(new \stdClass(), null, true),
            array(new \ClassWithToString(), 1, false),
            array(new \ClassWithToString(), null, false),
            array(new \ClassWithToString(), 100000, true),
            array(function(){ return false; }, null, true),
            array(function(){ return false; }, 100, true),
            array('', null, true),
            array(null, 1, true),
            array("a", null, false),
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
