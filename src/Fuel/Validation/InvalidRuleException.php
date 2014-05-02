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
 * Thrown when a specified rule is not known
 *
 * @package Fuel\Validation
 * @author  Fuel Development Team
 *
 * @since   2.0
 */
class InvalidRuleException extends InvalidArgumentException
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
		$error = 'VAL-004: The rule ['.$message.'] is not known.';

		parent::__construct($error, $code, $previous);
	}

}
