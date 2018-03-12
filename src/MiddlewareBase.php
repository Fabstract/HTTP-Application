<?php

namespace Fabs\Component\Http;

use Fabs\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MiddlewareBase
 * @package Fabs\Component\Http
 *
 * @property Request request
 */
abstract class MiddlewareBase extends ContainerAware implements MiddlewareInterface
{
    public function initialize()
    {
    }

    public function before()
    {
    }

    public function after()
    {
    }

    public function finalize()
    {

    }
}
