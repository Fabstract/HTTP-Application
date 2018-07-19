<?php

namespace Fabstract\Component\Http\Middleware;

use Fabstract\Component\Http\Constant\HttpHeaders;
use Fabstract\Component\Http\MiddlewareBase;

class AccessControlMiddleware extends MiddlewareBase
{
    public function before()
    {
        $this->response->headers->set(HttpHeaders::ACCESS_CONTROL_ALLOW_ORIGIN, $this->getAllowedOrigin());
        $this->response->headers->set(HttpHeaders::ACCESS_CONTROL_ALLOW_HEADERS, $this->getAllowedHeaders());
        $this->response->headers->set(HttpHeaders::ACCESS_CONTROL_ALLOW_METHODS, $this->getAllowedMethods());
        $this->response->headers->set(HttpHeaders::ACCESS_CONTROL_EXPOSE_HEADERS, $this->getExposedHeaders());
        $this->response->headers->set(HttpHeaders::ACCESS_CONTROL_MAX_AGE, $this->getMaxAgeSeconds());
        $this->response->headers->set(HttpHeaders::ACCESS_CONTROL_ALLOW_CREDENTIALS, $this->getAllowCredentials());
    }

    private function getAllowedOrigin()
    {
        $allowed_origin = $this->application_config->getAccessControlSettings()->getAllowedOrigin();
        if (is_array($allowed_origin)) {
            $origin = $this->request->headers->get(HttpHeaders::ORIGIN);
            foreach ($allowed_origin as $allowed_origin_element) {
                if ($allowed_origin_element === $origin) {
                    return $origin;
                }
            }

            return 'null';
        }

        return $allowed_origin === null ? 'null' : $allowed_origin;
    }

    /**
     * @return string
     */
    private function getAllowedHeaders()
    {
        return implode(", ", $this->application_config->getAccessControlSettings()->getAllowedHeaderList());
    }

    private function getAllowedMethods()
    {
        return implode(", ", $this->application_config->getAccessControlSettings()->getAllowedMethodList());
    }

    private function getExposedHeaders()
    {
        return implode(", ", $this->application_config->getAccessControlSettings()->getExposedHeaderList());
    }

    private function getMaxAgeSeconds()
    {
        return $this->application_config->getAccessControlSettings()->getMaxAgeSeconds();
    }

    private function getAllowCredentials()
    {
        return $this->application_config->getAccessControlSettings()->getAllowCredentials();
    }
}
