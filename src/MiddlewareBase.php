<?php

namespace Fabs\Component\Http;

use Fabs\Component\DependencyInjection\ContainerAware;

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
