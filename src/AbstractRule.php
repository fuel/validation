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
	 * Set to true to always run the rule when validating, regardless of if the data exists.
	 *
	 * @var bool
	 */
	protected $alwaysRun = false;

	/**
	 * Creates a new validation rule
	 *
	 * @param mixed  $params
	 * @param string $message
	 *
	 * @since 2.0
	 */
	public function __construct($params = null, $message = null)
	{
		$this->setParameter($params);

		if ($message)
		{
			$this->setMessage($message);
		}
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
	 * Should return a list of tokens that can be inserted into this rule's error message.
	 * For example this might be an upper bound for MaxValue or the regex passed to the Regex rule.
	 * Values should always have a string key so they can be easily identified.
	 *
	 * @return string[]
	 */
	public function getMessageParameters()
	{
		return array();
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

	public function canAlwaysRun()
	{
		return $this->alwaysRun;
	}

}
