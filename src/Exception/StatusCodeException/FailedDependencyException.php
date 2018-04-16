<?php

namespace Fabstract\Component\Http\Exception\StatusCodeException;


use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

class FailedDependencyException extends StatusCodeException
{
    /**
     * FailedDependencyException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(424, HttpStatus::FAILED_DEPENDENCY, $error_details);
    }
}