<?php

namespace Fabstract\Component\Http\Exception\StatusCodeException;


use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

class LoopDetectedException extends StatusCodeException
{
    /**
     * LoopDetectedException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(508, HttpStatus::LOOP_DETECTED, $error_details);
    }
}
