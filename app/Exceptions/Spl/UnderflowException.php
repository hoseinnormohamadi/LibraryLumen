<?php

namespace App\Exceptions\Spl;

use App\Exceptions\ExceptionInterface;
use App\Exceptions\ModuleExceptionTrait;
use UnderflowException as StandardUnderflowException;

/**
 * Class UnderflowException
 */
class UnderflowException extends StandardUnderflowException implements ExceptionInterface
{
    use ModuleExceptionTrait;
}