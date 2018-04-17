<?php

namespace Fabstract\Component\Http\Exception\StatusCodeException;


use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

class GatewayTimeoutException extends StatusCodeException
{
    /**
     * GatewayTimeoutException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(504, HttpStatus::GATEWAY_TIMEOUT, $error_details);
    }
}
