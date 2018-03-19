<?php

namespace Fabstract\Component\Http\ExceptionHandler;

use Fabstract\Component\Http\Exception\StatusCodeException\InternalServerErrorException;
use Fabstract\Component\Http\ExceptionHandlerInterface;
use Fabstract\Component\Http\ExceptionLoggerService;
use Fabstract\Component\Http\Injectable;

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
