<?php


namespace Fabs\Component\Http\Exception\StatusCodeException;


use Fabs\Component\Http\Constant\HttpStatus;
use Fabs\Component\Http\Exception\StatusCodeException;

class ConflictException extends StatusCodeException
{
    /**
     * ConflictException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(409, HttpStatus::CONFLICT, $error_details);
    }
}
