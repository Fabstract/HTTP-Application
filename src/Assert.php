<?php

namespace Fabs\Component\Http;

use Fabs\Component\Http\Exception\AssertionException;

class Assert extends \Fabs\Component\Assert\Assert
{
    protected static function generateException($name, $expected, $given)
    {
        $exception = parent::generateException($name, $expected, $given);
        return new AssertionException(
            $exception->getMessage(),
            $exception->getCode(),
            $exception
        );
    }
}
