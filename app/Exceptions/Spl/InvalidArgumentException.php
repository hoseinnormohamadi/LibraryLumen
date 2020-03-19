<?php

namespace App\Exceptions\Spl;

use App\Exceptions\ExceptionInterface;
use App\Exceptions\ModuleExceptionTrait;
use InvalidArgumentException as StandardInvalidArgumentException;

/**
 * Class InvalidArgumentException
 */
class InvalidArgumentException extends StandardInvalidArgumentException implements ExceptionInterface
{
    use ModuleExceptionTrait;
}