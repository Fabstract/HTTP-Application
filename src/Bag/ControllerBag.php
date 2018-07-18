<?php

namespace Fabstract\Component\Http\Bag;

use Fabstract\Component\Http\Definition\ControllerDefinition;

/**
 * Class ControllerBag
 * @package Fabstract\Component\Http\Bag
 *
 * @method ControllerDefinition add(ControllerDefinition $sa)
 * @method ControllerDefinition[] getAll()
 */
class ControllerBag extends ContainerAwareBagBase
{

    /**
     * @param string $route
     * @param string $class_name
     * @return ControllerDefinition
     */
    public function create($route, $class_name)
    {
        return $this->add(
            ControllerDefinition::create($route)->setClassName($class_name)
        );
    }

    protected function getContainerAwareElementClass()
    {
        return ControllerDefinition::class;
    }
}
