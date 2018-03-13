<?php

namespace Fabs\Component\Http;


use Fabs\Component\Http\Constant\Services;
use Fabs\Component\Http\Definition\ServiceDefinition\RequestDefinition;
use Fabs\Component\Http\Definition\ServiceDefinition\ResponseDefinition;
use Fabs\Component\Http\Definition\ServiceDefinition\RouterDefinition;
use Fabs\Component\Http\Definition\ServiceDefinition\SerializerDefinition;
use Fabs\Component\Router\Router;
use Fabs\Component\Serializer\JSONSerializer;

class Container extends \Fabs\Component\DependencyInjection\Container
{
    /**
     * Container constructor.
     * @param RequestDefinition $request_definition
     */
    public final function __construct($request_definition)
    {
        Assert::isType($request_definition, RequestDefinition::class, 'request_definition');

        $this->addServiceDefinitionConstraint(
            Services::ROUTER,
            RouterDefinition::class
        );

        $this->addServiceDefinitionConstraint(
            Services::REQUEST,
            RequestDefinition::class
        );

        $this->addServiceDefinitionConstraint(
            Services::RESPONSE,
            ResponseDefinition::class
        );

        $this->addServiceDefinitionConstraint(
            Services::SERIALIZER,
            SerializerDefinition::class
        );

        foreach ($this->getServices() as $service) {
            $this->add($service);
        }

        $this->add($request_definition);

        $this->onConstruct();
    }

    protected function onConstruct()
    {
    }

    private function getServices()
    {
        yield $this->getRouterDefinition();
        yield $this->getResponseDefinition();
        yield $this->getSerializerDefinition();
    }

    protected function getRouterDefinition()
    {
        $router_definition = new RouterDefinition();
        $router_definition->setCreator(function () {
            $router = new Router();
            $router->defineShortcut('#int', '(\d+)');
            return $router;
        });
        return $router_definition;
    }

    protected function getResponseDefinition()
    {
        $response_definition = new ResponseDefinition();
        $response_definition->setClassName(Response::class);
        return $response_definition;
    }

    protected function getSerializerDefinition()
    {
        $serializer_definition = new SerializerDefinition();
        // todo using JSONSerializer for now, it really shouldn't be JSONSerializer
        $serializer_definition->setClassName(JSONSerializer::class);
        return $serializer_definition;
    }
}
