<?php


namespace Fabstract\Component\Http\Exception\StatusCodeException;


use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

class InternalServerErrorException extends StatusCodeException
{
    /**
     * InternalServerErrorException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(500, HttpStatus::INTERNAL_SERVER_ERROR, $error_details);
    }
}