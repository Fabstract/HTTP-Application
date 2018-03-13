<?php

namespace Fabs\Component\Http\Middleware;

use Fabs\Component\Http\Exception\StatusCodeException\BadRequestException;
use Fabs\Component\Http\MiddlewareBase;
use Fabs\Component\Serializer\Exception\ParseException;

class SerializationMiddleware extends MiddlewareBase
{

    public function before()
    {
        if (isset($this->serializer)) {
            try {
                $decoded = $this->serializer->getEncoder()->decode($this->request->getContent());
                $this->request->setBody($decoded);
            } catch (ParseException $exception) {
                throw new BadRequestException();
            }
        }
    }

    public function after()
    {
        if (isset($this->serializer)) {
            $serialized = $this->serializer->serialize($this->response->getReturnedValue());
            $this->response->setContent($serialized);
        }
    }
}
