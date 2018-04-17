<?php

namespace Fabstract\Component\Http\Exception\StatusCodeException;


use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

class ExpectationFailedException extends StatusCodeException
{
    /**
     * ExpectationFailedException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(417, HttpStatus::EXPECTATION_FAILED, $error_details);
    }
}
