<?php


namespace Fabs\Component\Http\Constant;


class HttpHeaders
{
    const ACCESS_CONTROL_EXPOSE_HEADERS = 'Access-Control-Expose-Headers';
    const ACCESS_CONTROL_ALLOW_METHODS = 'Access-Control-Allow-Methods';
    const ACCESS_CONTROL_ALLOW_HEADERS = 'Access-Control-Allow-Headers';
    const ACCESS_CONTROL_ALLOW_ORIGIN = 'Access-Control-Allow-Origin';
    const X_HTTP_METHOD_OVERRIDE = 'X-HTTP-METHOD-OVERRIDE';
    const X_RATELIMIT_REMAINING = 'X-RateLimit-Remaining';
    const X_RATELIMIT_LIMIT = 'X-RateLimit-Limit';
    const X_RATELIMIT_RESET = 'X-RateLimit-Reset';
    const REQUEST_METHOD = 'REQUEST_METHOD';
    const IF_NONE_MATCH = 'If-None-Match';
    const CONTENT_TYPE = 'Content-Type';
    const ETAG = 'ETag';
}