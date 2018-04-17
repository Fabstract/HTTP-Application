<?php

namespace Fabstract\Component\Http\Exception\StatusCodeException;


use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

class PayloadTooLargeException extends StatusCodeException
{
    /**
     * PayloadTooLargeException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(413, HttpStatus::PAYLOAD_TOO_LARGE, $error_details);
    }
}
