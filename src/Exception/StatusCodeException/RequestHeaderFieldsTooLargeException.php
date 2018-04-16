<?php

namespace Fabstract\Component\Http\Exception\StatusCodeException;


use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

class RequestHeaderFieldsTooLargeException extends StatusCodeException
{
    /**
     * RequestHeaderFieldsTooLargeException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(431, HttpStatus::REQUEST_HEADER_FIELDS_TOO_LARGE, $error_details);
    }
}