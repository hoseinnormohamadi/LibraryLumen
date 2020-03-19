<?php

namespace App\Exceptions\Spl;

use App\Exceptions\ExceptionInterface;
use App\Exceptions\ModuleExceptionTrait;
use BadFunctionCallException as StandardBadFunctionCallException;

/**
 * Class BadFunctionCallException
 */
class BadFunctionCallException extends StandardBadFunctionCallException implements ExceptionInterface
{
    use ModuleExceptionTrait;
}