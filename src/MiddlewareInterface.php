<?php

namespace Fabs\Component\Http;

use Fabs\Component\DependencyInjection\ContainerAwareInterface;

interface MiddlewareInterface extends ContainerAwareInterface
{
    public function initialize();

    public function before();

    public function after();

    public function finalize();
}
