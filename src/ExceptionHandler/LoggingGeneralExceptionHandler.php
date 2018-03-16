<?php

namespace Fabs\Component\Http\ExceptionHandler;

use Fabs\Component\Http\Exception\StatusCodeException\InternalServerErrorException;
use Fabs\Component\Http\ExceptionHandlerInterface;
use Fabs\Component\Http\ExceptionLoggerService;
use Fabs\Component\Http\Injectable;

/**
 * Class LoggingGeneralExceptionHandler
 * @package Fabs\Component\Http\ExceptionHandler
 *
 * @property ExceptionLoggerService exception_logger
 */
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
