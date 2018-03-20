<?php

namespace Fabstract\Component\Http;

use Fabstract\Component\DateTimeHandler\DateTimeHandler;

class ExceptionLoggerService extends Injectable
{
    /** @var string */
    private $log_path = null;

    function __construct($log_path = 'exception_log.txt')
    {
        Assert::isNotEmptyString($log_path, 'log_path');

        $this->log_path = $log_path;
    }

    /**
     * @return string
     */
    public function getLogPath()
    {
        return $this->log_path;
    }

    /**
     * @param string $log_path
     */
    public function setLogPath($log_path)
    {
        Assert::isNotEmptyString($log_path, 'log_path');

        $this->log_path = $log_path;
    }

    /**
     * @param \Throwable $throwable
     * @param null|string $custom_log_path
     */
    public function log($throwable, $custom_log_path = null)
    {
        Assert::isType($throwable, \Throwable::class, 'exception');

        $log_path = $this->log_path;
        if ($custom_log_path !== null) {
            Assert::isNotEmptyString($custom_log_path, 'custom_log_path');

            $log_path = $custom_log_path;
        }

        $log_message = $this->createLogMessage($throwable);

        try {
            file_put_contents($log_path, $log_message, FILE_APPEND);
        } catch (\Exception $throwable) {
        }
    }

    /**
     * @param \Throwable $throwable
     * @return string
     */
    protected function createLogMessage($throwable)
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
