<?php

namespace App\Exceptions\Spl;

use App\Exceptions\ExceptionInterface;
use App\Exceptions\ModuleExceptionTrait;
use UnexpectedValueException as StandardUnexpectedValueException;

/**
 * Class UnexpectedValueException
 */
class UnexpectedValueException extends StandardUnexpectedValueException implements ExceptionInterface
{
    use ModuleExceptionTrait;
}