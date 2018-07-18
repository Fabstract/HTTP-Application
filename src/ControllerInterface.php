<?php

namespace Fabstract\Component\Http;

use Fabstract\Component\Http\Bag\EndpointBag;

interface ControllerInterface
{
    /**
     * @param EndpointBag $endpoint_bag
     * @return void
     */
    public function configureEndpointBag($endpoint_bag);
}
