<?php

namespace Fabstract\Component\Http\Exception\StatusCodeException;


use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

class VariantAlsoNegotiatesException extends StatusCodeException
{
    /**
     * VariantAlsoNegotiatesException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(506, HttpStatus::VARIANT_ALSO_NEGOTIATES, $error_details);
    }
}