<?php

namespace Fabstract\Component\Http\Constant;

class HttpStatus
{
    const FORBIDDEN = 'forbidden';
    const UNAUTHORIZED = 'unauthorized';
    const NOT_FOUND = 'not_found';
    const TOO_MANY_REQUEST = 'too_many_request';
    const BAD_REQUEST = 'bad_request';
    const UNPROCESSABLE_ENTITY = 'unprocessable_entity';
    const UNSUPPORTED_MEDIA_TYPE = 'unsupported_media_type';
    const METHOD_NOT_ALLOWED = 'method_not_allowed';
    const INTERNAL_SERVER_ERROR = 'internal_server_error';
    const CONFLICT = 'conflict';
    const NOT_ACCEPTABLE = 'not_acceptable';
    const PROXY_AUTHENTICATION_REQUIRED = 'proxy_authentication_required';
    const REQUEST_TIMEOUT = "request_timeout";
    const GONE = "gone";
    const LENGTH_REQUIRED = "length_required";
    const PRECONDITION_FAILED = "precondition_failed";
    const PAYLOAD_TOO_LARGE = "payload_too_large";
    const URI_TOO_LONG = "uri_too_long";
    const REQUESTED_RANGE_NOT_SATISFIABLE = "requsted_range_not_satisfiable";
    const EXPECTATION_FAILED = "expectation_failed";
    const MISDIRECTED_REQUEST = "misdirected_request";
    const LOCKED = "locked";
    const FAILED_DEPENDENCY = "failed_dependency";
    const UPGRADE_REQUIRED = "upgrade_required";
    const PRECONDITION_REQUIRED = "precondition_required";
    const REQUEST_HEADER_FIELDS_TOO_LARGE = "request_header_fields_too_large";
    const UNAVAILABLE_FOR_LEGAL_REASONS = "unavailable_for_legal_reasons";
    const NOT_IMPLEMENTED = "not_implemented";
    const BAD_GATEWAY = "bad_gateway";
    const SERVICE_UNAVAILABLE = "service_unavailable";
    const GATEWAY_TIMEOUT = "gateway_timeout";
    const HTTP_VERSION_NOT_SUPPORTED = "http_version_not_supported";
    const VARIANT_ALSO_NEGOTIATES = "variant_also_negotiates";
    const INSUFFICIENT_STORAGE = "insufficient_storage";
    const LOOP_DETECTED = "loop_detected";
    const NOT_EXTENDED = "not_extended";
    const NETWORK_AUTHENTICATION_REQUIRED = "network_authentication_required";

}
