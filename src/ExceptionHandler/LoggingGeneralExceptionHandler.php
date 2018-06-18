<?php

namespace Fabstract\Component\Http\ExceptionHandler;

use Fabstract\Component\Http\Exception\StatusCodeException\InternalServerErrorException;
use Fabstract\Component\Http\ExceptionHandlerInterface;
use Fabstract\Component\Http\Injectable;
use Fabstract\Component\Http\ThrowableLoggerInterface;
use Psr\Log\LoggerInterface;

/**
 * Class LoggingGeneralExceptionHandler
 * @package Fabs\Component\Http\ExceptionHandler
 *
 * @property LoggerInterface exception_logger
 */
class LoggingGeneralExceptionHandler extends Injectable implements ExceptionHandlerInterface
{
    /**
     * @param \Exception $exception
     * @throws InternalServerErrorException
     */
    public function handle($exception)
    {
        if ($this->getContainer()->has('exception_logger')) {
            if ($this->exception_logger instanceof ThrowableLoggerInterface) {
                $this->exception_logger->logThrowable($exception);
            } else {
                $this->exception_logger->error(strval($exception));
            }
        }

        throw new InternalServerErrorException();
    }
}
