<?php

namespace Fabs\Component\Http\Bag;

use Fabs\Component\Http\Assert;
use Fabs\Component\Http\Endpoint;
use Fabs\Component\Http\Injectable;

class EndpointBag extends Injectable
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
        $endpoint->setContainer($this->getContainer());
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
