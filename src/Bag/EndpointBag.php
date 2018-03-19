<?php

namespace Fabstract\Component\Http\Bag;

use Fabstract\Component\Http\Assert;
use Fabstract\Component\Http\Endpoint;
use Fabstract\Component\Http\Injectable;

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
