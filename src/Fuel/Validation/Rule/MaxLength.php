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

use Fuel\Validation\AbstractRule;

/**
 * Checks that the value is longer than the given maximum length.
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 */
class MaxLength extends AbstractRule
{

    public function __construct($params = null, $message = '')
    {
        parent::__construct($params, $message);

        if ($message == '')
        {
            $this->setMessage('The field is longer than the allowed maximum length.');
        }
    }

    /**
     * @param mixed $value
     * @param string    $field
     * @param array $allFields
     *
     * @return bool
     */
    public function validate($value, $field = null, &$allFields = null)
    {
        mb_internal_encoding("UTF-8");
        if ( is_object($value) && ! method_exists($value, '__toString') )
        {
            return true;
        }
        if (mb_strlen(( string ) $value) == 0 && $this->getParameter() >= 0)
        {
            return true;
        }
        return (mb_strlen(( string ) $value) <= $this->getParameter());
    }

}
