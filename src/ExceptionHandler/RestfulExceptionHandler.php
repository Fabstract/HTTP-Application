<?php

namespace Fabs\Component\Http\ExceptionHandler;

use Fabs\Component\Http\Assert;
use Fabs\Component\Http\Constant\HttpHeaders;
use Fabs\Component\Http\Constant\ResponseStatus;
use Fabs\Component\Http\Exception\StatusCodeException;
use Fabs\Component\Http\ExceptionHandlerBase;
use Fabs\Component\Http\Model\ErrorResponseModel;

class RestfulExceptionHandler extends ExceptionHandlerBase
{

    /**
     * @param StatusCodeException $exception
     */
    public function handle($exception)
    {
        Assert::isType($exception, StatusCodeException::class, 'exception');

        $error_response_model = new ErrorResponseModel();
        $error_response_model->status = ResponseStatus::FAILURE;
        $error_response_model->error_message = $exception->getMessage();
        $error_response_model->error_details = $exception->getErrorDetails();

        $content = $this->serializer->serialize($error_response_model);

        $this->response->headers->set(HttpHeaders::CONTENT_TYPE, 'application/json');
        $this->response
            ->setContent($content)
            ->setStatusCode($exception->getCode())
            ->send();
    }
}