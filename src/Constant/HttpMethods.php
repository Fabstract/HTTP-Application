<?php

namespace Fabs\Component\Http\Constant;

class HttpMethods
{
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const HEAD = 'HEAD';
    const DELETE = 'DELETE';
    const PATCH = 'PATCH';
    const OPTIONS = 'OPTIONS';


    const METHODS_WITH_BODY =
        [
            HttpMethods::POST,
            HttpMethods::PUT,
            HttpMethods::PATCH
        ];
}
