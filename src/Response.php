<?php

namespace Fabstract\Component\Http;

class Response extends \Symfony\Component\HttpFoundation\Response
{
    /** @var mixed */
    private $returned_value = null;

    /**
     * @return mixed
     */
    public function getReturnedValue()
    {
        return $this->returned_value;
    }

    /**
     * @param mixed $returned_value
     * @return Response
     */
    public function setReturnedValue($returned_value)
    {
        $this->returned_value = $returned_value;
        return $this;
    }

    /**
     *
     * WARNING: Middlewares and other classes should use setReturnedValue to override response's content.
     *
     * @see setReturnedValue()
     *
     * Sets the response content.
     *
     * Valid types are strings, numbers, null, and objects that implement a __toString() method.
     *
     * @param mixed $content Content that can be cast to string
     *
     * @return Response
     *
     * @throws \UnexpectedValueException
     */
    public function setContent($content)
    {
        /** @var Response $response */
        $response = parent::setContent($content);
        return $response;
    }
}