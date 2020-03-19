<?php

namespace App\Exceptions\Spl;

use App\Exceptions\ExceptionInterface;
use App\Exceptions\ModuleExceptionTrait;
use DomainException as StandardDomainException;

/**
 * Class DomainException
 */
class DomainException extends StandardDomainException implements ExceptionInterface
{
    use ModuleExceptionTrait;
}