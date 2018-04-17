<?php

namespace Fabstract\Component\Http\Exception\StatusCodeException;


use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

class NotImplementedException extends StatusCodeException
{
    /**
     * NotImplementedException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(501, HttpStatus::NOT_IMPLEMENTED, $error_details);
    }
}
