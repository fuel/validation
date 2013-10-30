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

/**
 * Main entry point for the validation functionality. Handles registering validation rules and loading validation
 * adaptors.
 *
 * @package Fuel\Validation
 * @author Steve West
 */
class Validation
{

	/**
	 * @var RuleInterface[]
	 */
	protected $rules = array();

	/**
	 * Adds a rule that can be used for validation
	 *
	 * @param string $name
	 * @param RuleInterface   $rule
	 *
	 * @return $this
	 */
	public function addRule($name, RuleInterface $rule)
	{
		$this->rules[$name] = $rule;

		return $this;
	}

	/**
	 * Removes a validation rule.
	 *
	 * @param $name
	 *
	 * @return $this
	 */
	public function removeRule($name)
	{
		if ($this->isRule($name))
		{
			unset($this->rules[$name]);
		}

		return $this;
	}

	/**
	 * Gets a validation rule
	 *
	 * @param string $name Name of the rule to get
	 *
	 * @return RuleInterface
	 * @throws \InvalidArgumentException If the rule is not known
	 */
	public function getRule($name)
	{
		if ( ! array_key_exists($name, $this->rules))
		{
			throw new \InvalidArgumentException('VAL-001: [' . $name . '] is not a known validation rule.');
		}

		return $this->rules[$name];
	}

	/**
	 * Checks if the given rule is known or not
	 *
	 * @param string $name
	 *
	 * @return bool
	 */
	public function isRule($name)
	{
		try
		{
			$this->getRule($name);
		}
		catch(\InvalidArgumentException $iae)
		{
			return false;
		}

		return true;
	}

	/**
	 * Returns a list of all known validation rules
	 *
	 * @return RuleInterface[]
	 */
	public function getRules()
	{
		return $this->rules;
	}

}
