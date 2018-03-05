<?php

namespace Fabs\Component\Http\Exception\StatusCodeException;

use Fabs\Component\Http\Constant\HttpStatus;
use Fabs\Component\Http\Exception\StatusCodeException;

class BadRequestException extends StatusCodeException
{
    /**
     * BadRequestException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(400, HttpStatus::BAD_REQUEST, $error_details);
    }
}
