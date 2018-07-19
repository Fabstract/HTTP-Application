<?php

namespace Fabstract\Component\Http\ApplicationConfig;

use Fabstract\Component\Http\Assert;
use Fabstract\Component\Http\Constant\HttpMethods;

class AccessControlSettingsConfig
{
    /** @var null|string|string[] */
    protected $allowed_origin = null;
    /** @var string[] */
    protected $allowed_header_list = [];
    /** @var string[] */
    protected $allowed_method_list = [];
    /** @var string[] */
    protected $exposed_header_list = [];
    /** @var int */
    protected $max_age_seconds = 0;
    /** @var bool */
    protected $allow_credentials = false;

    public function __construct()
    {
        $default_allowed_method_list =
            [
                HttpMethods::HEAD,
                HttpMethods::GET,
                HttpMethods::POST,
                HttpMethods::PUT,
                HttpMethods::PATCH,
                HttpMethods::DELETE,
                HttpMethods::OPTIONS
            ];
        $this->setAllowedMethodList($default_allowed_method_list);
    }

    /**
     * @return null|string|string[]
     */
    public function getAllowedOrigin()
    {
        return $this->allowed_origin;
    }

    /**
     * @return AccessControlSettingsConfig
     */
    public function allowAnyOrigin()
    {
        $this->allowed_origin = '*';
        return $this;
    }

    /**
     * @return AccessControlSettingsConfig
     */
    public function allowNoOrigin()
    {
        $this->allowed_origin = null;
        return $this;
    }

    /**
     * @param string $origin
     * @return AccessControlSettingsConfig
     */
    public function addAllowedOrigin($origin)
    {
        Assert::isNotEmptyString($origin, 'origin');

        if (is_array($this->allowed_origin) === true) {
            $this->allowed_origin[] = $origin;
        } else {
            $this->allowed_origin = [$origin];
        }

        return $this;
    }

    /**
     * @return string[]
     */
    public function getAllowedHeaderList()
    {
        return $this->allowed_header_list;
    }

    /**
     * @param string $header
     * @return AccessControlSettingsConfig
     */
    public function addAllowedHeader($header)
    {
        Assert::isNotEmptyString($header, 'header');

        $this->allowed_header_list[] = $header;
        return $this;
    }

    /**
     * @param string[] $allowed_header_list
     * @return AccessControlSettingsConfig
     */
    public function setAllowedHeaderList($allowed_header_list)
    {
        Assert::isArrayOfString($allowed_header_list, 'allowed_header_list');

        $this->allowed_header_list = $allowed_header_list;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getAllowedMethodList()
    {
        return $this->allowed_method_list;
    }

    /**
     * @param string $method
     * @return AccessControlSettingsConfig
     */
    public function addAllowedMethod($method)
    {
        Assert::isNotEmptyString($method, 'method');

        $this->allowed_method_list[] = $method;
        return $this;
    }

    /**
     * @param string[] $allowed_method_list
     * @return AccessControlSettingsConfig
     */
    public function setAllowedMethodList($allowed_method_list)
    {
        Assert::isArrayOfString($allowed_method_list, 'allowed_method_list');

        $this->allowed_method_list = $allowed_method_list;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getExposedHeaderList()
    {
        return $this->exposed_header_list;
    }

    /**
     * @param string $header
     * @return AccessControlSettingsConfig
     */
    public function addExposedHeader($header)
    {
        Assert::isNotEmptyString($header, 'header');

        $this->exposed_header_list[] = $header;
        return $this;
    }

    /**
     * @param string[] $exposed_header_list
     * @return AccessControlSettingsConfig
     */
    public function setExposedHeaderList($exposed_header_list)
    {
        Assert::isArrayOfString($exposed_header_list, 'exposed_header_list');

        $this->exposed_header_list = $exposed_header_list;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxAgeSeconds()
    {
        return $this->max_age_seconds;
    }

    /**
     * @param int $max_age_seconds
     * @return AccessControlSettingsConfig
     */
    public function setMaxAgeSeconds($max_age_seconds)
    {
        Assert::isNotNegative($max_age_seconds, 'max_age_seconds');

        $this->max_age_seconds = $max_age_seconds;
        return $this;
    }

    /**
     * @return bool
     */
    public function getAllowCredentials()
    {
        return $this->allow_credentials;
    }

    /**
     * @param bool $allow_credentials
     * @return AccessControlSettingsConfig
     */
    public function setAllowCredentials($allow_credentials)
    {
        Assert::isBoolean($allow_credentials, 'allow_credentials');

        $this->allow_credentials = $allow_credentials;
        return $this;
    }
}
