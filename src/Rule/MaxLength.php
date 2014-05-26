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

	/**
	 * Default failure message
	 *
	 * @var string
	 */
	protected $message = 'The field is longer than the allowed maximum length.';

	/**
	 * @param mixed  $value
	 * @param string $field
	 * @param array  $allFields
	 *
	 * @return bool
	 *
	 * @since 2.0
	 */
	public function validate($value, $field = null, $allFields = null)
	{
		if ( (is_object($value) and ! method_exists($value, '__toString')) or $this->getParameter() === null)
		{
			return false;
		}

		mb_internal_encoding('UTF-8');

		return (mb_strlen(( string ) $value) <= $this->getParameter());
	}

	/**
	 * Sets the value to check against
	 *
	 * @param string $params If an array the first value will be used
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function setParameter($params)
	{
		// Ensure we have only a single thing to match against
		if (is_array($params))
		{
			$params = array_shift($params);
		}

		return parent::setParameter($params);
	}

	/**
	 * Returns
	 *
	 * array(
	 * 		'maxLength' => <target length>
	 * );
	 *
	 * @return string[]
	 */
	public function getMessageParameters()
	{
		return array(
			'maxLength' => $this->getParameter(),
		);
	}

}
