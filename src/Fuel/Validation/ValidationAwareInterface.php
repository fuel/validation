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

/**
 * Defines a common interface for objects that can create validation rules for fields.
 *
 * @package Fuel\Validation
 * @author  Fuel Development Team
 * @since   2.0
 */
interface ValidationAwareInterface
{

	/**
	 * Should populate the given validator with the needed rules.
	 * If the validator is null one should be created.
	 *
	 * @param Validator $validator
	 *
	 * @return Validator
	 *
	 * @since 2.0
	 */
	public function populateValidation(Validator $validator);

}
