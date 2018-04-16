<?php

namespace Fabstract\Component\Http\Exception\StatusCodeException;


use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

class UriTooLongException extends StatusCodeException
{
    /**
     * UriTooLongException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(414, HttpStatus::URI_TOO_LONG, $error_details);
    }
}