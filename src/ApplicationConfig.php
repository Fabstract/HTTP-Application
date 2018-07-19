<?php

namespace Fabstract\Component\Http;

use Fabstract\Component\Http\ApplicationConfig\AccessControlSettingsConfig;

class ApplicationConfig
{
    /** @var bool */
    public $enable_exception_logger = false;
    /** @var bool */
    public $auto_allow_http_options = false;
    /** @var AccessControlSettingsConfig */
    public $access_control_settings = null;

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
    public function getAutoAllowHttpOptions()
    {
        return $this->auto_allow_http_options;
    }

    /**
     * @param bool $auto_allow_http_options
     * @return ApplicationConfig
     */
    public function setAutoAllowHttpOptions($auto_allow_http_options)
    {
        $this->auto_allow_http_options = $auto_allow_http_options;
        return $this;
    }

    /**
     * @return AccessControlSettingsConfig
     */
    public function getAccessControlSettings()
    {
        return $this->access_control_settings;
    }

    /**
     * @param AccessControlSettingsConfig $access_control_settings
     * @return ApplicationConfig
     */
    public function setAccessControlSettings($access_control_settings)
    {
        Assert::isType($access_control_settings, AccessControlSettingsConfig::class, 'access_control_settings');

        $this->access_control_settings = $access_control_settings;
        return $this;
    }
}
