<?php

namespace Fabstract\Component\Http\Exception\StatusCodeException;

use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

class UnprocessableEntityException extends StatusCodeException
{
    /**
     * UnprocessableEntity constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(422, HttpStatus::UNPROCESSABLE_ENTITY, $error_details);
    }
}
