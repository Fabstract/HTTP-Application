<?php

namespace Fabstract\Component\Http\Exception\StatusCodeException;


use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

class HttpVersionNotSupportedException extends StatusCodeException
{
    /**
     * HttpVersionNotSupportedException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(505, HttpStatus::HTTP_VERSION_NOT_SUPPORTED, $error_details);
    }
}
