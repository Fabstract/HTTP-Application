<?php

namespace Fabs\Component\Http\Exception\StatusCodeException;

use Fabs\Component\Http\Constant\HttpStatus;
use Fabs\Component\Http\Exception\StatusCodeException;

class NotFoundException extends StatusCodeException
{
    /**
     * NotFoundException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(404, HttpStatus::NOT_FOUND, $error_details);
    }
}
