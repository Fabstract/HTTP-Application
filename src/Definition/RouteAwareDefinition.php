<?php

namespace Fabstract\Component\Http\Definition;

use Fabstract\Component\DependencyInjection\Definition;
use Fabstract\Component\Http\Assert;
use Fabstract\Component\Http\MiddlewareAwareInterface;
use Fabstract\Component\Http\MiddlewareAwareTrait;
use Fabstract\Component\Router\RouteAwareInterface;

class RouteAwareDefinition extends Definition implements RouteAwareInterface, MiddlewareAwareInterface
{
    use MiddlewareAwareTrait;

    /** @var string */
    private $route = null;

    /**
     * RouteAwareDefinition constructor.
     * @param string $route
     */
    protected function __construct($route)
    {
        $this->setRoute($route);
    }

    public static function create($route)
    {
        return new static($route);
    }

    /**
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param string $route
     * @return $this
     */
    public function setRoute($route)
    {
        Assert::isNotNullOrWhiteSpace($route, 'route');
        $this->route = $route;
        return $this;
    }
}
