<?php
/**
 * @package   Fuel\Validation
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Validation\Provider;

use Fuel\Dependency\ServiceProvider;

/**
 * FuelServiceProvider implementation for Validation
 *
 * @package Fuel\Validation
 * @author  Fuel Development Team
 * @since   2.0
 */
class FuelServiceProvider extends ServiceProvider
{

	public $provides = array('validator');

	public function provide()
	{
		$this->register('validator', function ($dic)
		{
			return $dic->resolve('Fuel\Validation\Validator');
		});
	}


}
