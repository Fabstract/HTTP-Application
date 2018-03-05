<?php

namespace Fabs\Component\Http\Definition;

use Fabs\Component\DependencyInjection\SharedDefinition;
use Fabs\Component\Http\Assert;
use Fabs\Component\Router\RouteAwareInterface;

class ModuleDefinition extends SharedDefinition implements RouteAwareInterface
{
    /** @var string */
    private $route = null;

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
        Assert::isNotEmptyString($route, false, 'route');

        $this->route = $route;
        return $this;
    }
}
