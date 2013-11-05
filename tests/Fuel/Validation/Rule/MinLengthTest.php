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
 * Class MinLengthTest
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @covers  \Fuel\Validation\Rule\MinLength
 */
class MinLengthTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var MinLength
     */
    protected $object;

    protected function setUp()
    {
        $this->object = new MinLength;
        $this->object->setParameter(3);
    }

    /**
     * @coversDefaultClass __construct
     * @coversDefaultClass getMessage
     * @group              Validation
     */
    public function testGetMessage()
    {
        $this->assertEquals(
            'The field does not satisfy the minimum length requirement.',
            $this->object->getMessage()
        );
    }

    /**
     * @coversDefaultClass getMessage
     * @coversDefaultClass setMessage
     * @group              Validation
     */
    public function testSetGetMessage()
    {
        $message = 'This is a message used for testing.';

        $this->object->setMessage($message);

        $this->assertEquals(
            $message,
            $this->object->getMessage()
        );
    }

    /**
     * @coversDefaultClass validate
     * @dataProvider       validateProvider
     * @group              Validation
     */
    public function testValidate($stringValue, $minLength, $expected)
    {
       // echo 'Checking '.$stringValue.' to see if it is longer than '.$minLength."\n";
        $this->object->setParameter($minLength);
        $this->assertEquals(
            $expected,
            $this->object->validate($stringValue)
        );
    }

    /**
     * Provides sample data for testing the minimum length validation
     *
     * @return array
     */
    public function validateProvider()
    {
        return array(
            array('hello', 1, true),
            array('', 1, false),
            array('12345', 5, true),
            array('test.email.user@test.domain.tld', 500, false),
            array('ä', 1, true),
            array('', 0, true),
            array('', -1, true),
            array('z', 0, true),
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

        $object = new MinLength(null, $message);

        $this->assertEquals(
            $message,
            $object->getMessage()
        );
    }

}