<?php

namespace Fabstract\Component\Http\Bag;

use Fabstract\Component\Http\Endpoint;

/**
 * Class EndpointBag
 * @package Fabstract\Component\Http\Bag
 *
 * @method Endpoint add(Endpoint $sa)
 * @method Endpoint[] getAll()
 */
class EndpointBag extends ContainerAwareBagBase
{

    /**
     * @param string $route
     * @return Endpoint
     */
    public function create($route)
    {
        return $this->add(
            Endpoint::create($route)
        );
    }

    protected function getContainerAwareElementClass()
    {
        return Endpoint::class;
    }
}
