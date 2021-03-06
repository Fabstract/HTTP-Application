<?php

namespace Fabstract\Component\Http\Exception\StatusCodeException;


use Fabstract\Component\Http\Constant\HttpStatus;
use Fabstract\Component\Http\Exception\StatusCodeException;

class UpgradeRequiredException extends StatusCodeException
{
    /**
     * UpgradeRequiredException constructor.
     * @param mixed $error_details
     */
    public function __construct($error_details = null)
    {
        parent::__construct(426, HttpStatus::UPGRADE_REQUIRED, $error_details);
    }
}
