<?php

namespace Fabs\Component\Http;

class ApplicationConfig
{
    /** @var bool */
    public $enable_exception_logger = false;
    /** @var bool */
    public $auto_allow_options_for_endpoints = false;

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

    /**
     * @return bool
     */
    public function getAutoAllowOptionsForEndpoints()
    {
        return $this->auto_allow_options_for_endpoints;
    }

    /**
     * @param bool $auto_allow_options_for_endpoints
     * @return ApplicationConfig
     */
    public function setAutoAllowOptionsForEndpoints($auto_allow_options_for_endpoints)
    {
        $this->auto_allow_options_for_endpoints = $auto_allow_options_for_endpoints;
        return $this;
    }
}
