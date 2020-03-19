<?php

namespace App\Exceptions\Spl;

use App\Exceptions\ExceptionInterface;
use App\Exceptions\ModuleExceptionTrait;
use LogicException as StandardLogicException;

/**
 * Class LogicException
 */
class LogicException extends StandardLogicException implements ExceptionInterface
{
    use ModuleExceptionTrait;
}