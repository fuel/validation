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

class MacTest extends AbstractRuleTest
{

	/**
	 * {@inheritdocs}
	 */
	protected $message = 'The field is not a valid MAC address.';

	protected function _before()
	{
		$this->object = new Mac;
	}

	/**
	 * {@inheritdocs}
	 */
	public function validateProvider()
	{
		return array(
			array('000CF15698AD', true),
			array('00:0C:F1:56:98:AD', true),
			array('00-0C-F1-56-98-AD', true),
			array('000Cf15698ad', true),
			array('00-0c:f1:56-98ad', true),
			array('CF15698AD', false),
			array('00:0C:Q1:56:98:AD', false),
			array('00-0C-F1/56-98-AD', false),
			array('000Cf15698aq', false),
			array('0c:f1:56-98ad', false),
		);
	}

}
