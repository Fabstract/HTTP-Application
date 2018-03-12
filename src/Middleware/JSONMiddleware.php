<?php

namespace Fabs\Component\Http\Middleware;

use Fabs\Component\Http\Constant\HttpHeaders;
use Fabs\Component\Http\Constant\HttpMethods;
use Fabs\Component\Http\Exception\StatusCodeException\UnsupportedMediaTypeException;
use Fabs\Component\Http\MiddlewareBase;

class JSONMiddleware extends MiddlewareBase
{
    public function before()
    {
        echo 'before json';
        exit;
        $is_body_required =
            $this->request->isMethod(HttpMethods::POST) ||
            $this->request->isMethod(HttpMethods::PUT) ||
            $this->request->isMethod(HttpMethods::PATCH);

        if ($is_body_required) {
            $content_type = $this->request->headers->get(HttpHeaders::CONTENT_TYPE);
            $expected = 'application/json';
            if ($content_type !== $expected) {
                throw new UnsupportedMediaTypeException([
                    HttpHeaders::CONTENT_TYPE => $content_type,
                    'expected' => $expected
                ]);
            }

            $data = $this->request->getContent();
            var_dump($data);
//            if (count($data) === 0) {
//                if (json_last_error() !== JSON_ERROR_NONE) {
//                    throw  new BadRequestException();
//                } else {
//                    throw new UnprocessableEntityException();
//                }
//            }
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