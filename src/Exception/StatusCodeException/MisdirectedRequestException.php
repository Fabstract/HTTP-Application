<?php

namespace Fabstract\Component\Http\Exception\StatusCodeException;


use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

class MisdirectedRequestException extends StatusCodeException
{
    /**
     * MisdirectedRequestException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(421, HttpStatus::MISDIRECTED_REQUEST, $error_details);
    }
}