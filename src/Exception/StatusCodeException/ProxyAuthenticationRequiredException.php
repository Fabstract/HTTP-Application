<?php

namespace Fabstract\Component\Http\Exception\StatusCodeException;


use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

class ProxyAuthenticationRequiredException extends StatusCodeException
{
    /**
     * ProxyAuthenticationRequiredException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(407, HttpStatus::PROXY_AUTHENTICATION_REQUIRED, $error_details);
    }
}
