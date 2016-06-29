<?php
/**
 * @package   Fuel\Validation
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2016 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Validation;

/**
 * Defines an object that can perform validation.
 */
interface ValidatableInterface
{
	/**
	 * Takes an array of data and validates that against the assigned rules.
	 * The array is expected to have keys named after fields.
	 * This function will call reset() before it runs.
	 *
	 * @param array           $data
	 * @param ResultInterface $result
	 *
	 * @return ResultInterface
	 *
	 * @since 2.0
	 */
	public function run($data, ResultInterface $result = null);
}
