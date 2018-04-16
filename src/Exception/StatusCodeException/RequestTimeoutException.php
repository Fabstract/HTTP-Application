<?php

namespace Fabstract\Component\Http\Exception\StatusCodeException;


use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

class RequestTimeoutException extends StatusCodeException
{
    /**
     * RequestTimeoutException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(408, HttpStatus::REQUEST_TIMEOUT, $error_details);
    }
}