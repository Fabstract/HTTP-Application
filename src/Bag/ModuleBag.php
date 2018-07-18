<?php

namespace Fabstract\Component\Http\Bag;

use Fabstract\Component\Http\Definition\ModuleDefinition;

/**
 * Class ModuleBag
 * @package Fabstract\Component\Http\Bag
 *
 * @method ModuleDefinition add(ModuleDefinition $sa)
 * @method ModuleDefinition[] getAll()
 */
class ModuleBag extends ContainerAwareBagBase
{

    /**
     * @param string $route
     * @param string $class_name
     * @return ModuleDefinition
     */
    public function create($route, $class_name)
    {
        return $this->add(
            ModuleDefinition::create($route)->setClassName($class_name)
        );
    }

    protected function getContainerAwareElementClass()
    {
        return ModuleDefinition::class;
    }
}
