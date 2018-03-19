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
}
