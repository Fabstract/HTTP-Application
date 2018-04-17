<?php

namespace Fabstract\Component\Http\Exception\StatusCodeException;


use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

class PreconditionFailedException extends StatusCodeException
{
    /**
     * PreconditionFailedException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(412, HttpStatus::PRECONDITION_FAILED, $error_details);
    }
}
