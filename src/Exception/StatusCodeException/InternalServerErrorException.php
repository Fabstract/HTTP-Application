<?php


namespace Fabs\Component\Http\Exception\StatusCodeException;


use Fabs\Component\Http\Constant\HttpStatus;
use Fabs\Component\Http\Exception\StatusCodeException;

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