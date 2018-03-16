<?php

namespace Fabs\Component\Http\ExceptionHandler;

use Fabs\Component\Http\Exception\StatusCodeException\InternalServerErrorException;
use Fabs\Component\Http\ExceptionHandlerInterface;
use Fabs\Component\Http\Injectable;

class LoggingGeneralExceptionHandler extends Injectable implements ExceptionHandlerInterface
{
    /**
     * @param \Exception $exception
     * @throws InternalServerErrorException
     */
    public function handle($exception)
    {
        $this->exception_logger->log($exception, 'internal_server_error_log.txt');

        throw new InternalServerErrorException();
    }
}
