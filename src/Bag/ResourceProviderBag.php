<?php

namespace Fabs\Component\Http\Bag;

use Fabs\Component\Http\Assert;
use Fabs\Component\Http\Definition\ResourceProviderDefinition;
use Fabs\Component\Http\Injectable;

class ResourceProviderBag extends Injectable
{
    /**
     * @var ResourceProviderDefinition[]
     */
    private $resource_provider_definition_list = [];

    /**
     * @param ResourceProviderDefinition $resource_provider_definition
     * @return ResourceProviderDefinition
     */
    public function addDefinition($resource_provider_definition)
    {
        Assert::isType($resource_provider_definition, ResourceProviderDefinition::class, 'resource_provider_definition');
        $resource_provider_definition->setContainer($this->getContainer());
        $this->resource_provider_definition_list[] = $resource_provider_definition;
        return $resource_provider_definition;
    }

    /**
     * @param string $route
     * @param string $class_name
     * @return ResourceProviderDefinition
     */
    public function add($route, $class_name)
    {
        return $this->addDefinition(
            ResourceProviderDefinition::create($route)->setClassName($class_name)
        );
    }

    /**
     * @return ResourceProviderDefinition[]
     */
    public function getAll()
    {
        return $this->resource_provider_definition_list;
    }
}
