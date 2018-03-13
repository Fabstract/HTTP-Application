<?php

namespace Fabs\Component\Http\Middleware;

use Fabs\Component\Http\Constant\HttpHeaders;
use Fabs\Component\Http\Exception\StatusCodeException\UnsupportedMediaTypeException;
use Fabs\Component\Http\MiddlewareBase;

class JSONContentMiddleware extends MiddlewareBase
{
    public function before()
    {
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
//        if ($this->response->isSent() === false) {
//            $returned_value = $this->response->setContentTypeJson()->getReturnedValue();
//            if ($returned_value instanceof ResponseModel) {
//                $response_model = $returned_value;
//            } else {
//                $response_model = new ResponseModel();
//                $response_model->status = ResponseStatus::SUCCESS;
//                $response_model->data = $returned_value;
//            }
//
//            $this->response->setReturnedValue($response_model);
//        }
    }
}