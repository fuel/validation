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
 * Defines a common interface for fields that can be validated
 *
 * @package Fuel\Validation
 * @author  Fuel Development Team
 *
 * @since 2.0
 */
interface FieldInterface
{

	/**
	 * Gets the label of this field
	 *
	 * @return string
	 *
	 * @since 2.0
	 */
	public function getLabel();

	/**
	 * Sets a list of rules to validate this field with
	 *
	 * @param RuleInterface[] $rules
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function addRule(RuleInterface $rules);

	/**
	 * Gets the machine name of this field
	 *
	 * @return string
	 *
	 * @since 2.0
	 */
	public function getName();

	/**
	 * Sets the label of this field
	 *
	 * @param string $friendlyName
	 *
	 * @return $this;
	 *
	 * @since 2.0
	 */
	public function setLabel($friendlyName);

	/**
	 * Returns a list of rules that will be used to validate this field
	 *
	 * @return RuleInterface[]
	 *
	 * @since 2.0
	 */
	public function getRules();

	/**
	 * Sets the machine name of this field
	 *
	 * @param string $name
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function setName($name);

}
