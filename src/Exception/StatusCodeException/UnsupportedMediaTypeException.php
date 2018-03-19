<?php

namespace Fabstract\Component\Http\Exception\StatusCodeException;

use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

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
