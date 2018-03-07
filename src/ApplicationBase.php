<?php

namespace Fabs\Component\Http;

use Fabs\Component\DependencyInjection\ServiceDefinition;
use Fabs\Component\Http\Bag\EndpointBag;
use Fabs\Component\Http\Bag\ResourceBag;
use Fabs\Component\Http\Bag\ResourceProviderBag;
use Fabs\Component\Http\Constant\Services;
use Fabs\Component\Http\Definition\ResourceDefinition;
use Fabs\Component\Http\Definition\ResourceProviderDefinition;
use Fabs\Component\Http\Definition\ServiceDefinition\RequestDefinition;
use Fabs\Component\Http\Exception\StatusCodeException\MethodNotAllowedException;
use Fabs\Component\Http\Exception\StatusCodeException\NotFoundException;

abstract class ApplicationBase extends DefinitionAwareInjectable implements MiddlewareAwareInterface
{
    use MiddlewareAwareTrait;

    public final function __construct()
    {
        $this->setContainer(new Container($this->getRequestDefinition()));

        $application_definition = new ServiceDefinition();
        $application_definition->setInstance($this)
            ->setShared(true)
            ->setName(Services::APPLICATION);

        $this->getContainer()->add($application_definition);

        $this->onConstruct();
    }

    protected function onConstruct()
    {
    }

    /**
     * @return void
     */
    public abstract function run();

    /**
     * @param ResourceProviderBag $resource_provider_bag
     * @return void
     */
    protected abstract function configureResourceProviderBag($resource_provider_bag);

    /**
     * @return RequestDefinition
     */
    protected abstract function getRequestDefinition();

    /**
     * @throws NotFoundException
     */
    protected function handle()
    {
        $resource_provider_bag = new ResourceProviderBag();
        $resource_provider_bag->setContainer($this->getContainer());
        $this->configureResourceProviderBag($resource_provider_bag);

        $resource_provider_definition_list = $resource_provider_bag->getAll();

        $uri = $this->request->getPathInfo();

        $resource_provider_match_result = $this->router->match($uri, $resource_provider_definition_list);
        if ($resource_provider_match_result === null) {
            throw new NotFoundException("res provider not found");
        }

        /** @var ResourceProviderDefinition $matched_resource_provider_definition */
        $matched_resource_provider_definition = $resource_provider_match_result->getRouteAware();

        /** @var ResourceProviderInterface $resource_provider */
        $resource_provider = $matched_resource_provider_definition->getInstance();

        $resource_bag = new ResourceBag();
        $resource_bag->setContainer($this->getContainer());
        $resource_provider->configureResourceBag($resource_bag);

        $endpoint_definition_list = $resource_bag->getAll();

        $resource_match_result = $this->router->match($resource_provider_match_result->getRestOfUri(), $endpoint_definition_list);
        if ($resource_match_result === null) {
            throw new NotFoundException("resource not found");
        }

        /** @var ResourceDefinition $matched_resource_definition */
        $matched_resource_definition = $resource_match_result->getRouteAware();

        /** @var ResourceInterface $resource */
        $resource = $matched_resource_definition->getInstance();

        $endpoint_bag = new EndpointBag();
        $resource->configureEndpointBag($endpoint_bag);

        /** @var Endpoint[] $endpoint_list */
        $endpoint_list = $endpoint_bag->getAll();

        $endpoint_match_result = $this->router->match($resource_match_result->getRestOfUri(), $endpoint_list);
        if ($endpoint_match_result === null) {
            throw new NotFoundException("endpoint not found");
        }

        /** @var Endpoint $endpoint */
        $endpoint = $endpoint_match_result->getRouteAware();

        $http_method = $this->request->getMethod();
        $matched_action = $endpoint->getAction($http_method);
        if ($matched_action === null) {
            throw new MethodNotAllowedException();
        }


        $this->executeInitialize();
        $matched_resource_provider_definition->executeInitialize();
        $matched_resource_definition->executeInitialize();
        $matched_action->executeInitialize();


        $this->executeBefore();
        $matched_resource_provider_definition->executeBefore();
        $matched_resource_definition->executeBefore();
        $matched_action->executeBefore();

        $output = $matched_action->execute($resource, $endpoint_match_result->getParameters());
        $this->response->setContent($output);

        $matched_action->executeAfter();
        $matched_resource_definition->executeAfter();
        $matched_resource_provider_definition->executeAfter();
        $this->executeAfter();

        $matched_action->executeFinalize();
        $matched_resource_definition->executeFinalize();
        $matched_resource_provider_definition->executeFinalize();
        $this->executeFinalize();
    }

    public final function setContainer($container)
    {
        Assert::isType($container, Container::class, 'container');
        return parent::setContainer($container);
    }
}
