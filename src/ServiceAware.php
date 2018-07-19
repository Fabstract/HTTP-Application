<?php

namespace Fabstract\Component\Http;

use Fabstract\Component\DependencyInjection\ContainerAwareInterface;
use Fabstract\Component\Router\Router;
use Fabstract\Component\Serializer\SerializerInterface;

/**
 * Interface ServiceAware
 * @package Fabstract\Component\Http
 *
 * @property Request request
 * @property Response response
 * @property Router router
 * @property SerializerInterface serializer
 * @property ApplicationConfig application_config
 */
interface ServiceAware extends ContainerAwareInterface
{
}
