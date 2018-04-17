<?php

namespace Fabstract\Component\Http\Exception\StatusCodeException;


use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

class InsufficientStorageException extends StatusCodeException
{
    /**
     * InsufficientStorageException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(507, HttpStatus::INSUFFICIENT_STORAGE, $error_details);
    }
}
