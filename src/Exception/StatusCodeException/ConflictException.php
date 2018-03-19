<?php


namespace Fabstract\Component\Http\Exception\StatusCodeException;


use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

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
