<?php

namespace Fabs\Component\Http\Middleware;

use Fabs\Component\Http\Assert;
use Fabs\Component\Http\Constant\HttpHeaders;
use Fabs\Component\Http\Constant\HttpMethods;
use Fabs\Component\Http\Exception\StatusCodeException\BadRequestException;
use Fabs\Component\Http\Exception\StatusCodeException\UnsupportedMediaTypeException;
use Fabs\Component\Http\JSONRequest;
use Fabs\Component\Http\MiddlewareBase;
use Fabs\Component\Serializer\JSONSerializer;

/**
 * Class JSONMiddleware
 * @package Fabs\Component\Http\Middleware
 *
 * @property JSONRequest request
 */
class JSONMiddleware extends MiddlewareBase
{
    public function before()
    {
        $raw_body = $this->request->getContent();
        if ($raw_body === '') {
            return;
        }

        if ($this->methodNeedsEncoding() !== true) {
            return;
        }

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

        Assert::isType($this->request, JSONRequest::class, 'request');
        Assert::isType($this->serializer, JSONSerializer::class, 'serializer');

        $decoded_content = $this->serializer->getEncoder()->decode($raw_body);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new BadRequestException();
        }
        $this->request->setDecodedContent($decoded_content);
    }

    /**
     * @return bool
     */
    private function methodNeedsEncoding()
    {
        foreach (HttpMethods::METHODS_WITH_BODY as $method) {
            if ($this->request->isMethod($method)) {
                return true;
            }
        }

        return false;
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