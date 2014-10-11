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
 * Checks that the value is a valid date
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @since 2.0
 */
class Date extends AbstractRule
{

	/**
	 * Contains the rule failure message
	 *
	 * @var string
	 */
	protected $message = 'The field does not contain a valid date.';

	/**
	 * @param mixed $value Value to be validated
	 * @param null  $field Unused by this rule
	 * @param null  $allFields
	 *
	 * @internal param null $allFields Unused by this rule
	 *
	 * @return bool
	 *
	 * @since 2.0
	 */
	public function validate($value, $field = null, $allFields = null)
	{
		$parameters = $this->getParameter();
		$format = $parameters['format'];

		if ( (is_object($value) and ! method_exists($value, '__toString')) or $this->getParameter() === null )
		{
			return false;
		}

		if ( ! $format )
		{
			return false;
		}

		$date = date_parse_from_format($format, (string) $value);

		return ( $date['error_count'] + $date['warning_count'] === 0 );

	}

	/**
	 * Returns
	 *
	 * array(
	 *      'format' => <format value>
	 * );
	 *
	 * @return array
	 *
	 * @since 2.0
	 */
	public function getMessageParameters()
	{
		$parameters = $this->getParameter();
		$format = $parameters['format'];

		return array(
			'format' => $format,
		);
	}

}
