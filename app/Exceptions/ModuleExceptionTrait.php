<?php
namespace App\Exceptions;

/**
 * Trait ModuleExceptionTrait
 */
trait ModuleExceptionTrait
{
	/**
	 * The name of the module that has thrown the exception.
	 *
	 * @var string $_bnModule
	 */
	protected $_bnModule;

	/**
	 * Set the name of the module that has thrown the exception.
	 *
	 * @since 0.1.0
	 *
	 * @param mixed $module Name of the module that has thrown the exception.
	 * @return void.
	 */
	public function setModule($module)
	{
	    $this->_bnModule = (string)$module;
	}

	/**
	 * Get the name of the module that has thrown the exception.
	 *
	 * @return string name of the module that has thrown the exception
	 */
	public function getModule()
	{
		return (string)$this->_bnModule;
	}
}
