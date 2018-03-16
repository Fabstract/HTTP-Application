<?php

namespace Fabs\Component\Http\ExceptionHandler;

use Fabs\Component\Http\Exception\StatusCodeException\InternalServerErrorException;
use Fabs\Component\Http\ExceptionHandlerInterface;

class LoggingGeneralExceptionHandler implements ExceptionHandlerInterface
{
    /** @var string */
    private $log_path = null;

    function __construct($log_path = 'internal_server_error_log.txt')
    {
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
        $this->log_path = $log_path;
    }

    /**
     * @param \Exception $exception
     * @throws InternalServerErrorException
     */
    public function handle($exception)
    {
        try {
            $log_message = $this->createLogMessage($exception);
            file_put_contents($this->log_path, $log_message, FILE_APPEND);
        } catch (\Exception $exception) {
        }

        throw new InternalServerErrorException();
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
            "\n%s\n\n message: %s \n file: %s:%s\n stacktrace: %s \n inputs: %s\n context: %s\n\n",
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
