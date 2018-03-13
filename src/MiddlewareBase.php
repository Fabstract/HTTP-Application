<?php

namespace Fabs\Component\Http;

use Fabs\Component\DependencyInjection\Injectable;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MiddlewareBase
 * @package Fabs\Component\Http
 *
 * @property Request request
 */
abstract class MiddlewareBase extends Injectable implements MiddlewareInterface
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
