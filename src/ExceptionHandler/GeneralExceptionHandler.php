<?php

namespace Fabstract\Component\Http\ExceptionHandler;

use Fabstract\Component\Http\Exception\StatusCodeException\InternalServerErrorException;
use Fabstract\Component\Http\ExceptionHandlerBase;

class GeneralExceptionHandler extends ExceptionHandlerBase
{
    /**
     * @param \Exception $exception
     * @throws InternalServerErrorException
     */
    public function handle($exception)
    {
        throw new InternalServerErrorException();
    }
}
