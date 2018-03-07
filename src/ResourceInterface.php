<?php

namespace Fabs\Component\Http;

use Fabs\Component\DependencyInjection\DefinitionAwareInterface;
use Fabs\Component\Http\Bag\EndpointBag;

interface ResourceInterface extends DefinitionAwareInterface
{
    /**
     * @param EndpointBag $endpoint_bag
     * @return void
     */
    public function configureEndpointBag($endpoint_bag);
}
