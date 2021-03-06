<?php

namespace Fabstract\Component\Http;

use Fabstract\Component\Http\Bag\EndpointBag;

/**
 * Interface ResourceInterface
 * @package Fabstract\Component\Http
 *
 * @deprecated Use ControllerInterface instead.
 * @see ControllerInterface
 */
interface ResourceInterface
{
    /**
     * @param EndpointBag $endpoint_bag
     * @return void
     */
    public function configureEndpointBag($endpoint_bag);
}
