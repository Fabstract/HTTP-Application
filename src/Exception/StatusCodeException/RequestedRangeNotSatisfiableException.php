<?php

namespace Fabstract\Component\Http\Exception\StatusCodeException;


use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

class RequestedRangeNotSatisfiableException extends StatusCodeException
{
    /**
     * RequestedRangeNotSatisfiableException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(416, HttpStatus::REQUESTED_RANGE_NOT_SATISFIABLE, $error_details);
    }
}
