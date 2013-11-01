<?php

/**
 * Part of the FuelPHP framework.
 *
 * @package   Fuel\Validation
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */

namespace Fuel\Validation;

use Fuel\Validation\Exception\InvalidField;

/**
 * Main entry point for the validation functionality. Handles registering validation rules and loading validation
 * adaptors.
 *
 * @package Fuel\Validation
 * @author  Fuel Development Team
 */
class Validation
{

	/**
	 * @var RuleInterface[]
	 */
	protected $rules = array();

	/**
	 * Adds a rule that can be used to validate a field
	 *
	 * @param string        $field
	 * @param RuleInterface $rule
	 *
	 * @return $this
	 */
	public function addRule($field, RuleInterface $rule)
	{
		$this->rules[$field][] = $rule;

		return $this;
	}

	/**
	 * Adds a new field to the validation object
	 *
	 * @param string $field
	 *
	 * @return $this
	 */
	public function addField($field)
	{
		$this->rules[$field] = array();

		return $this;
	}

	/**
	 * Returns a list of all known validation rules for a given field.
	 *
	 * @param string $field Name of the field to get rules for, or null for all fields
	 *
	 * @return RuleInterface[]|string[RuleInterface[]]
	 */
	public function getRules($field = null)
	{
		// Check if we are fetching a specific field or all
		if ( ! is_null($field))
		{
			// Now we know we have a field check that we know about it
			if (array_key_exists($field, $this->rules))
			{
				// It's a known field so grab the rules for it
				$results = $this->rules[$field];
			}
			// If not throw an exception
			else
			{
				throw new InvalidField($field);
			}
		}
		else
		{
			// No field was specified so return all the fields' rules
			$results = $this->rules;
		}

		return $results;
	}

}
