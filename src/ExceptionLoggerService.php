<?php

namespace Fabs\Component\Http;

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
     * @param \Exception $exception
     * @param null|string $custom_log_path
     */
    public function log($exception, $custom_log_path = null)
    {
        Assert::isType($exception, \Exception::class, 'exception');

        $log_path = $this->log_path;
        if ($custom_log_path !== null) {
            Assert::isNotEmptyString($custom_log_path, 'custom_log_path');

            $log_path = $custom_log_path;
        }

        $log_message = $this->createLogMessage($exception);

        try {
            file_put_contents($log_path, $log_message, FILE_APPEND);
        } catch (\Exception $exception) {
        }
    }

    /**
     * @param \Exception $exception
     * @return string
     */
    protected function createLogMessage($exception)
    {
        $exception_sequence = $this->getExceptionSequence($exception);
        $request_input = $this->getRequestInput();
        $request_context_string = $this->getRequestContext();

        $log_message = sprintf(
            "\n>>\n%s\n\n%s\n\n message: %s \n file: %s:%s\n stacktrace: %s \n inputs: %s\n context: %s\n<<\n",
            DateTimeHandler::currentTime(),
            $exception_sequence,
            $exception->getMessage(),
            $exception->getFile(),
            strval($exception->getLine()),
            $exception->getTraceAsString(),
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
     * @param \Exception $exception
     * @return string
     */
    protected function getExceptionSequence($exception)
    {
        $exception_class_list = [];
        while ($exception !== null) {
            $exception_class_list[] = get_class($exception);
            $exception = $exception->getPrevious();
        }

        return implode($exception_class_list, "\nprev: ");
    }
}
