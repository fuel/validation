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
 * Checks that the given value matches the regex passed to setParameter()
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Devleopment Team
 *
 * @since 2.0
 */
class Regex extends AbstractRule
{

	/**
	 * Contains the rule failure message
	 *
	 * @var string
	 */
	protected $message = 'The field does not match the given pattern.';

	/**
	 * @param mixed  $value Value to validate
	 * @param string $field Unused by this rule
	 * @param array  $allFields Unused by this rule
	 *
	 * @return bool
	 *
	 * @since 2.0
	 */
	public function validate($value, $field = null, $allFields = null)
	{
		$regex = $this->getParameter();

		if ( ! is_string($value) or $regex === null)
		{
			return false;
		}

		return preg_match($regex, $value) == true;
	}

	/**
	 * Returns
	 *
	 * array(
	 * 		'pattern' => <Regex used for matching>
	 * );
	 *
	 * @return string[]
	 */
	public function getMessageParameters()
	{
		return array(
			'pattern' => $this->getParameter(),
		);
	}

}
