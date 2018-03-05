<?php

namespace Fabs\Component\Http\Exception\StatusCodeException;

use Fabs\Component\Http\Constant\HttpStatus;
use Fabs\Component\Http\Exception\StatusCodeException;

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
