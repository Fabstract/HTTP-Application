<?php

namespace Fabs\Component\Http\Definition;

use Fabs\Component\DependencyInjection\Definition;
use Fabs\Component\Http\Assert;
use Fabs\Component\Http\MiddlewareAwareInterface;
use Fabs\Component\Http\MiddlewareAwareTrait;
use Fabs\Component\Router\RouteAwareInterface;

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
