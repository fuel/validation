<?php
/**
 * @package   Fuel\Validation
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Validation\Rule;

use Fuel\Validation\AbstractRule;
use Fuel\Validation\ValidatableInterface;
use InvalidArgumentException;

/**
 * Allows validation of nested data structures.
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @since   2.0
 */
class Validator extends AbstractRule
{

	/**
	 * {@inheritdoc}
	 */
	protected $message = 'The child model is invalid.';

	/**
	 * @param ValidatableInterface $params
	 *
	 * @return $this
	 */
	public function setParameter($params)
	{
		if ( $params !== null && ! $params instanceof ValidatableInterface) {
			throw new InvalidArgumentException('VAL-009: Provided parameter does not implement ValidatableInterface');
		}

		return parent::setParameter($params);
	}

	/**
	 * {@inheritdoc}
	 */
	public function validate($value, $field = null, $allFields = null)
	{
		/** @var ValidatableInterface $validator */
		$validator = $this->getParameter();

		return $validator->run($value);
	}

}
