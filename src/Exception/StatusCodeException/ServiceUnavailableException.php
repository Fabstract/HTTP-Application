<?php

namespace Fabstract\Component\Http\Exception\StatusCodeException;


use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

class ServiceUnavailableException extends StatusCodeException
{
    /**
     * ServiceUnavailableException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(503, HttpStatus::SERVICE_UNAVAILABLE, $error_details);
    }
}
