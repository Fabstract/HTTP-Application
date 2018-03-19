<?php

namespace Fabstract\Component\Http;

use Fabstract\Component\DependencyInjection\ContainerAwareInterface;

interface MiddlewareInterface extends ContainerAwareInterface
{
    public function initialize();

    public function before();

    public function after();

    public function finalize();
}
