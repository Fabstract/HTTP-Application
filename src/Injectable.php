<?php

namespace Fabstract\Component\Http;

use Fabstract\Component\Router\Router;
use Fabstract\Component\Serializer\SerializerInterface;

/**
 * Class Injectable
 * @package Fabs\Component\Http
 *
 * @property Request request
 * @property Response response
 * @property Router router
 * @property SerializerInterface serializer
 */
class Injectable extends \Fabstract\Component\DependencyInjection\Injectable
{

}
