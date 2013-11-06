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
     * @coversDefaultClass validate
     * @dataProvider       validateProvider
     * @group              Validation
     */
    public function testValidate($stringValue, $minLength, $expected)
    {
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

        $object = new MinLength(null, $message);

        $this->assertEquals(
            $message,
            $object->getMessage()
        );
    }

}

/**
 * Class ClassWithToString
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 */
class ClassWithToString
{
    function __toString()
    {
        return '1234567890'; //returns string of length 10.
    }

}
