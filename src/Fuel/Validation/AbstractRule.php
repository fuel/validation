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
 * Tests the AbstractRule class
 *
 * @package Fuel\Validation
 * @author  Fuel Development Team
 */
abstract class AbstractRule implements RuleInterface
{

	/**
	 * Contains the rule failure message
	 *
	 * @var string
	 */
	protected $message;

	/**
	 * Contains any parameters needed by validation rules
	 *
	 * @var mixed
	 */
	protected $params;

	/**
	 * Creates a new validation rule
	 *
	 * @param mixed  $params
	 * @param string $message
	 *
	 * @codeCoverageIgnore
	 */
	public function __construct($params = null, $message = '')
	{
		$this->setParameter($params);
		$this->setMessage($message);
	}

	/**
	 * Gets the failure message for this rule
	 *
	 * @return string
	 */
	public function getMessage()
	{
		return $this->message;
	}

	/**
	 * Sets the failure message for this rule
	 *
	 * @param string $message
	 *
	 * @return $this
	 */
	public function setMessage($message)
	{
		$this->message = $message;
		return $this;
	}

	/**
	 * Sets the parameter for this validation rule.
	 * See each Rule's documentation for what this should be.
	 *
	 * @param mixed $params
	 *
	 * @return $this
	 */
	public function setParameter($params)
	{
		$this->params = $params;
		return $this;
	}

	/**
	 * Returns the value of the set parameter.
	 * See each Rule's documentation for what the parameter does.
	 *
	 * @return mixed
	 */
	public function getParameter()
	{
		return $this->params;
	}

}
