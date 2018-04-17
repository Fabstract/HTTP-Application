<?php

namespace Fabstract\Component\Http\Exception\StatusCodeException;


use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

class NotAcceptableException extends StatusCodeException
{
    /**
     * NotAcceptableException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(406, HttpStatus::NOT_ACCEPTABLE, $error_details);
    }
}
