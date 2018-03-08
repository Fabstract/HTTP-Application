<?php

namespace Fabs\Component\Http;

use Fabs\Component\Http\Bag\EndpointBag;

interface ResourceInterface
{
    /**
     * @param EndpointBag $endpoint_bag
     * @return void
     */
    public function configureEndpointBag($endpoint_bag);
}
