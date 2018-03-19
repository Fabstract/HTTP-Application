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
}