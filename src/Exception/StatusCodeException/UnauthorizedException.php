<?php


namespace Fabstract\Component\Http\Exception\StatusCodeException;


use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

class UnauthorizedException extends StatusCodeException
{
    /**
     * UnauthorizedException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(401, HttpStatus::UNAUTHORIZED, $error_details);
    }
}
