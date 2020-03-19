<?php

namespace App\Exceptions\Spl;

use App\Exceptions\ExceptionInterface;
use App\Exceptions\ModuleExceptionTrait;
use RuntimeException as StandardRuntimeException;

/**
 * Class RuntimeException
 */
class RuntimeException extends StandardRuntimeException implements ExceptionInterface
{
    use ModuleExceptionTrait;
}