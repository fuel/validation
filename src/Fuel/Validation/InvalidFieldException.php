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

use Exception;
use InvalidArgumentException;

/**
 * Thrown when a specified field is invalid
 *
 * @package Fuel\Validation
 * @author  Fuel Development Team
 *
 * @since   2.0
 */
class InvalidFieldException extends InvalidArgumentException
{

	/**
	 * @param string     $message  This is expected to be left blank or be a field name
	 * @param int        $code
	 * @param \Exception $previous
	 *
	 * @since 2.0
	 */
	public function __construct($message = '', $code = 0, Exception $previous = null)
	{
		$error = 'VAL-002: The field ['.$message.'] is not known.';

		if (empty($message))
		{
			$error = 'VAL-001: The specified field is not known.';
		}

		parent::__construct($error, $code, $previous);
	}

}
