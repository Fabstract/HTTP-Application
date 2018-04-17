<?php

namespace Fabstract\Component\Http\Exception\StatusCodeException;


use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

class LengthRequiredException extends StatusCodeException
{
    /**
     * LengthRequiredException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(411, HttpStatus::LENGTH_REQUIRED, $error_details);
    }
}
