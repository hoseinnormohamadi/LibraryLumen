<?php

namespace App\Exceptions\Spl;

use App\Exceptions\ExceptionInterface;
use App\Exceptions\ModuleExceptionTrait;
use BadMethodCallException as StandardBadMethodCallException;

/**
 * Class BadMethodCallException
 */
class BadMethodCallException extends StandardBadMethodCallException implements ExceptionInterface
{
    use ModuleExceptionTrait;
}