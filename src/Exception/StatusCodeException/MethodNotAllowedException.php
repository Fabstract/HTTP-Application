<?php

namespace Fabstract\Component\Http\Exception\StatusCodeException;

use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

class MethodNotAllowedException extends StatusCodeException
{
    /**
     * MethodNotAllowedException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(405, HttpStatus::METHOD_NOT_ALLOWED, $error_details);
    }
}
