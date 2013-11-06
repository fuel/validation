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
 * Tests the AbstractRule class
 *
 * @package Fuel\Validation
 * @author  Fuel Development Team
 * @since   2.0
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
	 * @since 2.0
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
	 *
	 * @since 2.0
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
	 *
	 * @since 2.0
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
	 *
	 * @since 2.0
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
	 *
	 * @since 2.0
	 */
	public function getParameter()
	{
		return $this->params;
	}

}
