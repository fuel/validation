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
 * Defines a field that can be validated
 *
 * @package Fuel\Validation
 * @author  Fuel Development Team
 *
 * @since 2.0
 */
class Field
{

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var string
	 */
	protected $friendlyName;

	/**
	 * @var RuleInterface[]
	 */
	protected $rules;

	/**
	 * Sets the friendly name of this field
	 *
	 * @param string $friendlyName
	 *
	 * @return $this;
	 *
	 * @since 2.0
	 */
	public function setFriendlyName($friendlyName)
	{
		$this->friendlyName = $friendlyName;

		return $this;
	}

	/**
	 * Gets the friendly name of this field
	 *
	 * @return string
	 *
	 * @since 2.0
	 */
	public function getFriendlyName()
	{
		return $this->friendlyName;
	}

	/**
	 * Sets the machine name of this field
	 *
	 * @param string $name
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * Gets the machine name of this field
	 *
	 * @return string
	 *
	 * @since 2.0
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Sets a list of rules to validate this field with
	 *
	 * @param RuleInterface[] $rules
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function addRule(RuleInterface $rules)
	{
		$this->rules[] = $rules;

		return $this;
	}

	/**
	 * Returns a list of rules that will be used to validate this field
	 *
	 * @return RuleInterface[]
	 *
	 * @since 2.0
	 */
	public function getRules()
	{
		return $this->rules;
	}

}
