<?php

namespace Fabs\Component\Http\ExceptionHandler;

use Fabs\Component\Http\Exception\StatusCodeException\InternalServerErrorException;
use Fabs\Component\Http\ExceptionHandlerBase;

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
