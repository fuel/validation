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

use Fuel\Validation\AbstractRule;

/**
 * Checks that a string value is no longer than the given maximum allowed length.
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @since 2.0
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
	 *
	 * @since 2.0
	 */
	public function validate($value, $field = null, &$allFields = null)
	{
		mb_internal_encoding('UTF-8');
		if ( is_object($value) && ! method_exists($value, '__toString') )
		{
			return true;
		}
		return (mb_strlen(( string ) $value) <= $this->getParameter());
	}

}
