<?php



namespace App\Exceptions;

/**
 * Interface ExceptionInterface.
 */
interface ExceptionInterface
{
	/**
	 * Get the name of the module that has thrown the exception.
	 *
	 * @return string name of the module that has thrown the exception
	 */
	public function getModule();

	/**
	 * Set the name of the module that has thrown the exception.
	 *
	 * @param string $module Name of the module that has thrown the exception.
	 * @return void
	 */
	public function setModule( string $module);
}
