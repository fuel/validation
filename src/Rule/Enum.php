<?php
/**
 * @package   Fuel\Validation
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2016 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Validation\Rule;

use Fuel\Validation\AbstractRule;

class Enum extends AbstractRule
{

	/**
	 * Default failure message
	 *
	 * @var string
	 */
	protected $message = 'The value given is not in the list of allowed values.';

	/**
	 * Sets the values to check against
	 *
	 * @param string $params
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function setParameter($params)
	{
		if ( ! is_array($params))
		{
			$params = [$params];
		}

		return parent::setParameter($params);
	}

	/**
	 * Returns
	 *
	 * array(
	 * 		'values' => <target length>
	 * );
	 *
	 * @return string[]
	 */
	public function getMessageParameters()
	{
		return array(
			'values' => implode('|', $this->getParameter()),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function validate($value, $field = null, $allFields = null)
	{
		return in_array($value, $this->getParameter());
	}
}
