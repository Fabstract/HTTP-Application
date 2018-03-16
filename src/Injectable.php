<?php

namespace Fabs\Component\Http;

use Fabs\Component\Router\Router;
use Fabs\Component\Serializer\SerializerInterface;

/**
 * Class Injectable
 * @package Fabs\Component\Http
 *
 * @property Request request
 * @property Response response
 * @property Router router
 * @property SerializerInterface serializer
 * @property ExceptionLoggerService exception_logger
 */
class Injectable extends \Fabs\Component\DependencyInjection\Injectable
{

}
