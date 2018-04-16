<?php

namespace Fabstract\Component\Http\Exception\StatusCodeException;


use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

class UnavailableForLegalReasonsException extends StatusCodeException
{
    /**
     * UnavailableForLegalReasonsException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(451, HttpStatus::UNAVAILABLE_FOR_LEGAL_REASONS, $error_details);
    }
}