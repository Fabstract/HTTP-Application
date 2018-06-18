<?php

namespace Fabstract\Component\Http;

use Fabstract\Component\DateTimeHandler\DateTimeHandler;
use Psr\Log\LoggerInterface;

class SimpleExceptionLoggerService implements LoggerInterface, ThrowableLoggerInterface
{
    /** @var string */
    private $log_path = null;

    /**
     * SimpleExceptionLoggerService constructor.
     * @param string $log_path
     */
    public function __construct($log_path = 'exception_log.txt')
    {
        Assert::isNotEmptyString($log_path, 'log_path');

        $this->log_path = $log_path;
    }

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function emergency($message, array $context = array())
    {
        $this->log('emergency', $message, $context);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function alert($message, array $context = array())
    {
        $this->log('alert', $message, $context);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function critical($message, array $context = array())
    {
        $this->log('critical', $message, $context);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function error($message, array $context = array())
    {
        $this->log('error', $message, $context);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function warning($message, array $context = array())
    {
        $this->log('warning', $message, $context);
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function notice($message, array $context = array())
    {
        $this->log('notice', $message, $context);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function info($message, array $context = array())
    {
        $this->log('info', $message, $context);
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function debug($message, array $context = array())
    {
        $this->log('debug', $message, $context);
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function log($level, $message, array $context = array())
    {
        try {
            file_put_contents($this->log_path, $message, FILE_APPEND);
        } catch (\Exception $throwable) {
        }
    }

    /**
     * @param \Throwable $throwable
     */
    public function logThrowable($throwable)
    {
        Assert::isType($throwable, \Throwable::class, 'exception');

        $log_message = $this->createLogMessageForThrowable($throwable);
        $this->log('throwable', $log_message);
    }

    /**
     * @param \Throwable $throwable
     * @return string
     */
    protected function createLogMessageForThrowable($throwable)
    {
        $exception_sequence = $this->getExceptionSequence($throwable);
        $request_input = $this->getRequestInput();
        $request_context_string = $this->getRequestContext();

        $log_message = sprintf(
            "\n>>\n%s\n\n%s\n\n message: %s \n file: %s:%s\n stacktrace: %s \n inputs: %s\n context: %s\n<<\n",
            DateTimeHandler::currentTime(),
            $exception_sequence,
            $throwable->getMessage(),
            $throwable->getFile(),
            strval($throwable->getLine()),
            $throwable->getTraceAsString(),
            $request_input,
            $request_context_string
        );

        return $log_message;
    }

    /**
     * @return string
     */
    private function getRequestInput()
    {
        try {
            return file_get_contents('php://input');
        } catch (\Exception $exception) {
            return "";
        }
    }

    /**
     * @return array|string
     */
    private function getRequestContext()
    {
        try {
            return json_encode($_SERVER);
        } catch (\Exception $exception) {
            return "null";
        }
    }

    /**
     * @param \Throwable $throwable
     * @return string
     */
    protected function getExceptionSequence($throwable)
    {
        $exception_class_list = [];
        while ($throwable !== null) {
            $exception_class_list[] = get_class($throwable);
            $throwable = $throwable->getPrevious();
        }

        return implode($exception_class_list, "\nprev: ");
    }
}
