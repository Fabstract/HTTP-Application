<?php

namespace Fabstract\Component\Http\Exception\StatusCodeException;


use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

class NotExtendedException extends StatusCodeException
{
    /**
     * NotExtendedException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(510, HttpStatus::NOT_EXTENDED, $error_details);
    }
}
