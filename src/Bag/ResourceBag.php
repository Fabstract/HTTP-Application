<?php

namespace Fabstract\Component\Http\Bag;

use Fabstract\Component\Http\Assert;
use Fabstract\Component\Http\Definition\ResourceDefinition;
use Fabstract\Component\Http\Injectable;

class ResourceBag extends Injectable
{
    /**
     * @var ResourceDefinition[]
     */
    private $resource_definition_list = [];

    /**
     * @param ResourceDefinition $resource_definition
     * @return ResourceDefinition
     */
    public function addDefinition($resource_definition)
    {
        Assert::isType($resource_definition, ResourceDefinition::class, 'resource_definition');
        $resource_definition->setContainer($this->getContainer());
        $this->resource_definition_list[] = $resource_definition;
        return $resource_definition;
    }

    /**
     * @param string $route
     * @param string $class_name
     * @return ResourceDefinition
     */
    public function create($route, $class_name)
    {
        return $this->addDefinition(
            ResourceDefinition::create($route)->setClassName($class_name)
        );
    }

    /**
     * @return ResourceDefinition[]
     */
    public function getAll()
    {
        return $this->resource_definition_list;
    }
}
