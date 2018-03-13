<?php

namespace Fabs\Component\Http\Middleware;

use Fabs\Component\Http\Assert;
use Fabs\Component\Http\Constant\HttpHeaders;
use Fabs\Component\Http\Constant\ResponseStatus;
use Fabs\Component\Http\Exception\StatusCodeException\UnsupportedMediaTypeException;
use Fabs\Component\Http\MiddlewareBase;
use Fabs\Component\Http\Model\ResponseModel;
use Fabs\Component\Serializer\JSONSerializer;

class JSONMiddleware extends MiddlewareBase
{
    public function before()
    {
        Assert::isType($this->serializer, JSONSerializer::class, 'serializer');

        $content_type = $this->request->headers->get(HttpHeaders::CONTENT_TYPE);
        $expected = 'application/json';
        if ($content_type !== $expected) {
            throw new UnsupportedMediaTypeException(
                [
                    HttpHeaders::CONTENT_TYPE => $content_type,
                    'expected' => $expected
                ]
            );
        }
    }

    public function after()
    {
        $returned_value = $this->response->getReturnedValue();
        if ($returned_value instanceof ResponseModel) {
            $response_model = $returned_value;
        } else {
            $response_model = new ResponseModel();
            $response_model->status = ResponseStatus::SUCCESS;
            $response_model->data = $returned_value;
        }

        $this->response->setReturnedValue($response_model);
        $this->response->headers->set(HttpHeaders::CONTENT_TYPE, 'application/json');
    }
}
