<?php

/**
 * Part of the FuelPHP framework.
 *
 * @package   Fuel\Validation
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */

namespace Fuel\Validation\Exception;

/**
 * Thrown when a specified field is invalid
 *
 * @package Fuel\Validation\Exception
 * @author  Fuel Development Team
 */
class InvalidField extends \InvalidArgumentException
{

	/**
	 * @param string     $message  This is expected to be left blank or be a field name
	 * @param int        $code
	 * @param \Exception $previous
	 */
	public function __construct($message = '', $code = 0, \Exception $previous = null)
	{
		if (empty($message))
		{
			$message = 'VAL-001: The specified field is not known.';
		}
		else
		{
			$message = 'VAL-002: The field ['.$message.'] is not known.';
		}

		parent::__construct($message, $code, $previous);
	}

}
