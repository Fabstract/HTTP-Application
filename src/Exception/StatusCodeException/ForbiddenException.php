<?php


namespace Fabs\Component\Http\Exception\StatusCodeException;


use Fabs\Component\Http\Constant\HttpStatus;
use Fabs\Component\Http\Exception\StatusCodeException;

class ForbiddenException extends StatusCodeException
{
    /**
     * ForbiddenException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(403, HttpStatus::FORBIDDEN, $error_details);
    }
}
