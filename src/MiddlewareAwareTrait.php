<?php

namespace Fabs\Component\Http;

use Fabs\Component\DependencyInjection\ContainerAwareInterface;
use Fabs\Component\Http\Definition\MiddlewareDefinition;

trait MiddlewareAwareTrait
{

    /** @var MiddlewareDefinition[] */
    private $middleware_definition_list = [];

    /**
     * @param MiddlewareDefinition $middleware_definition
     * @return $this
     */
    public function addMiddlewareDefinition($middleware_definition)
    {
        Assert::isType($middleware_definition, MiddlewareDefinition::class, 'middleware_definition');
        if ($this instanceof ContainerAwareInterface) {
            $middleware_definition->setContainer($this->getContainer());
        }
        $this->middleware_definition_list[] = $middleware_definition;
        return $this;
    }

    /**
     * @param string $middleware_class_name
     * @param mixed[] $parameters
     * @return $this
     */
    public function addMiddleware($middleware_class_name, ...$parameters)
    {
        Assert::isClassExists($middleware_class_name);

        $middleware_definition = new MiddlewareDefinition();
        $middleware_definition->setClassName($middleware_class_name)
            ->setParameters($parameters);

        return $this->addMiddlewareDefinition($middleware_definition);
    }

    public function executeInitialize()
    {
        foreach ($this->middleware_definition_list as $middleware_definition) {
            $middleware_definition->getInstance()->initialize();
        }
    }

    public function executeBefore()
    {
        foreach ($this->middleware_definition_list as $middleware_definition) {
            $middleware_definition->getInstance()->before();
        }
    }

    public function executeAfter()
    {
        $this->middleware_definition_list = array_reverse($this->middleware_definition_list);
        foreach ($this->middleware_definition_list as $middleware_definition) {
            $middleware_definition->getInstance()->after();
        }
    }

    public function executeFinalize()
    {
        foreach ($this->middleware_definition_list as $middleware_definition) {
            $middleware_definition->getInstance()->finalize();
        }
    }
}
