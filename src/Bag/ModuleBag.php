<?php

namespace Fabstract\Component\Http\Bag;

use Fabstract\Component\DependencyInjection\ContainerAware;
use Fabstract\Component\Http\Assert;
use Fabstract\Component\Http\Definition\ModuleDefinition;

class ModuleBag extends ContainerAware
{
    /** @var ModuleDefinition[] */
    private $module_definition_list = [];

    /**
     * @param ModuleDefinition $module_definition
     * @return ModuleDefinition
     */
    public function addDefinition($module_definition)
    {
        Assert::isType($module_definition, ModuleDefinition::class, 'module definition');
        $module_definition->setContainer($this->getContainer());
        $this->module_definition_list[] = $module_definition;
        return $module_definition;
    }

    /**
     * @param string $route
     * @param string $class_name
     * @return ModuleDefinition
     */
    public function create($route, $class_name)
    {
        return $this->addDefinition(
            ModuleDefinition::create($route)->setClassName($class_name)
        );
    }

    /**
     * @return ModuleDefinition[]
     */
    public function getAll()
    {
        return $this->module_definition_list;
    }
}
