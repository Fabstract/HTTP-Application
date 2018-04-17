<?php

namespace Fabstract\Component\Http\Exception\StatusCodeException;


use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

class NetworkAuthenticationRequiredException extends StatusCodeException
{
    /**
     * NetworkAuthenticationRequiredException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(511, HttpStatus::NETWORK_AUTHENTICATION_REQUIRED, $error_details);
    }
}
