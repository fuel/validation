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
class Field implements FieldInterface
{

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var string
	 */
	protected $label;

	/**
	 * @var RuleInterface[]
	 */
	protected $rules = [];

	public function __construct($name = null, $friendlyName = null)
	{
		$this->setName($name);
		$this->setLabel($friendlyName);
	}

	/**
	 * Sets the label of this field
	 *
	 * @param string $friendlyName
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function setLabel($friendlyName)
	{
		$this->label = $friendlyName;

		return $this;
	}

	/**
	 * Gets the label of this field
	 *
	 * @return string
	 *
	 * @since 2.0
	 */
	public function getLabel()
	{
		if ($this->label === null)
		{
			return $this->getName();
		}

		return $this->label;
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
	 * Sets a rule to validate this field with
	 *
	 * @param RuleInterface $rule
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function addRule(RuleInterface $rule)
	{
		$this->rules[] = $rule;

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
