<?php

namespace Fabstract\Component\Http\Exception\StatusCodeException;


use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

class BadGatewayException extends StatusCodeException
{
    /**
     * BadGatewayException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(502, HttpStatus::BAD_GATEWAY, $error_details);
    }
}
