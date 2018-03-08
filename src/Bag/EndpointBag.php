<?php

namespace Fabs\Component\Http\Bag;

use Fabs\Component\Http\Assert;
use Fabs\Component\Http\Endpoint;

class EndpointBag
{
    /**
     * @var Endpoint[]
     */
    private $endpoint_list = [];

    /**
     * @param Endpoint $endpoint
     * @return Endpoint
     */
    public function addEndpoint($endpoint)
    {
        Assert::isType($endpoint, Endpoint::class, 'endpoint');
        $this->endpoint_list[] = $endpoint;
        return $endpoint;
    }

    /**
     * @param string $route
     * @return Endpoint
     */
    public function create($route)
    {
        return $this->addEndpoint(
            Endpoint::create($route)
        );
    }

    /**
     * @return Endpoint[]
     */
    public function getAll()
    {
        return $this->endpoint_list;
    }
}
