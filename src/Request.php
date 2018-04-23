<?php

namespace Fabstract\Component\Http;

class Request extends \Symfony\Component\HttpFoundation\Request
{
    /** @var mixed */
    private $body = null;

    /**
     * @param mixed $body
     * @return Request
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getClientPublicIp()
    {
        $full_ip = $this->getClientIp();
        $ip_parts = explode(',', $full_ip);
        return $ip_parts[0];
    }

    /**
     * @return string|null
     */
    public function getClientLocalIp()
    {
        $full_ip = $this->getClientIp();
        $ip_parts = explode(',', $full_ip);
        if (count($ip_parts) > 1) {
            return $ip_parts[1];
        }

        return null;
    }
}
