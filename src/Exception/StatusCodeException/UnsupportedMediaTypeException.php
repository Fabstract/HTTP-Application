<?php

namespace Fabs\Component\Http\Exception\StatusCodeException;

use Fabs\Component\Http\Constant\HttpStatus;
use Fabs\Component\Http\Exception\StatusCodeException;

class UnsupportedMediaTypeException extends StatusCodeException
{
    /**
     * UnsupportedMediaTypeException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(415, HttpStatus::UNSUPPORTED_MEDIA_TYPE, $error_details);
    }
}
