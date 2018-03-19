<?php

namespace Fabstract\Component\Http;

use Fabstract\Component\Http\Exception\AssertionException;

class Assert extends \Fabstract\Component\Assert\Assert
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
