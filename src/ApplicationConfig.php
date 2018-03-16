<?php

namespace Fabs\Component\Http;

class ApplicationConfig
{
    /** @var bool */
    public $enable_exception_logger = false;

    /**
     * @return bool
     */
    public function isExceptionLoggerEnabled()
    {
        return $this->enable_exception_logger;
    }

    /**
     * @return ApplicationConfig
     */
    public function enableExceptionLogger()
    {
        $this->enable_exception_logger = true;
        return $this;
    }

    /**
     * @return ApplicationConfig
     */
    public function disableExceptionLogger()
    {
        $this->enable_exception_logger = false;
        return $this;
    }
}
