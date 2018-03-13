<?php

namespace Fabs\Component\Http;

class Request extends \Symfony\Component\HttpFoundation\Request
{
    /** @var mixed */
    private $decoded_content = null;

    /**
     * @return mixed
     */
    public function getDecodedContent()
    {
        return $this->decoded_content;
    }

    /**
     * @param mixed $decoded_content
     */
    public function setDecodedContent($decoded_content)
    {
        $this->decoded_content = $decoded_content;
    }
}