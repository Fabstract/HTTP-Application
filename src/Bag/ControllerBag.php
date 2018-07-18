<?php

namespace Fabstract\Component\Http\Bag;

use Fabstract\Component\Http\Assert;
use Fabstract\Component\Http\Definition\ControllerDefinition;
use Fabstract\Component\Http\Injectable;

class ControllerBag extends Injectable
{
    /**
     * @var ControllerDefinition[]
     */
    private $controller_definition_list = [];

    /**
     * @param ControllerDefinition $controller_definition
     * @return ControllerDefinition
     */
    public function addDefinition($controller_definition)
    {
        Assert::isType($controller_definition, ControllerDefinition::class, 'controller_definition');
        $controller_definition->setContainer($this->getContainer());
        $this->controller_definition_list[] = $controller_definition;
        return $controller_definition;
    }

    /**
     * @param string $route
     * @param string $class_name
     * @return ControllerDefinition
     */
    public function create($route, $class_name)
    {
        return $this->addDefinition(
            ControllerDefinition::create($route)->setClassName($class_name)
        );
    }

    /**
     * @return ControllerDefinition[]
     */
    public function getAll()
    {
        return $this->controller_definition_list;
    }
}
