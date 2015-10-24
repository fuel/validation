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
 * Checks that the given field exists if the conditional field is passed and is not empty
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @since   2.0
 */
class RequiredIf extends Required
{

	/**
	 * @param mixed $value
	 * @param null  $field
	 * @param null  $allFields
	 *
	 * @return bool
	 *
	 * @since 2.0
	 */
	public function validate($value, $field = null, $allFields = null)
	{
		$requiredField = $this->getParameter();

		if ($allFields !== null and array_key_exists($requiredField, $allFields) and ! empty($allFields[$requiredField]))
		{
			return parent::validate($value, $field, $allFields);
		}

		return true;
	}

}
