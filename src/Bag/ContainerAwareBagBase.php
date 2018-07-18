<?php

namespace Fabstract\Component\Http\Bag;

use Fabstract\Component\DependencyInjection\ContainerAware;
use Fabstract\Component\Http\Assert;
use Fabstract\Component\Http\Injectable;

abstract class ContainerAwareBagBase extends Injectable
{
    /**
     * @var ContainerAware[]
     */
    protected $container_aware_element_list = [];

    /**
     * @param ContainerAware $container_aware_element
     * @return ContainerAware
     */
    public function add($container_aware_element)
    {
        $container_aware_element_class = static::getContainerAwareElementClass();
        Assert::isChildOf($container_aware_element_class, ContainerAware::class, 'container_aware_element_class');
        Assert::isType($container_aware_element, $container_aware_element_class, 'container_aware_element');
        $container_aware_element->setContainer($this->getContainer());
        $this->container_aware_element_list[] = $container_aware_element;
        return $container_aware_element;
    }

    /**
     * @return ContainerAware[]
     */
    public function getAll()
    {
        return $this->container_aware_element_list;
    }

    protected abstract function getContainerAwareElementClass();
}
