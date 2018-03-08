<?php

namespace Fabs\Component\Http;

use Fabs\Component\DependencyInjection\ServiceDefinition;
use Fabs\Component\Http\Bag\EndpointBag;
use Fabs\Component\Http\Bag\ModuleBag;
use Fabs\Component\Http\Bag\ResourceBag;
use Fabs\Component\Http\Bag\ServiceBag;
use Fabs\Component\Http\Constant\Services;
use Fabs\Component\Http\Definition\ModuleDefinition;
use Fabs\Component\Http\Definition\ResourceDefinition;
use Fabs\Component\Http\Definition\ServiceDefinition\RequestDefinition;
use Fabs\Component\Http\Exception\StatusCodeException\MethodNotAllowedException;
use Fabs\Component\Http\Exception\StatusCodeException\NotFoundException;
use Fabs\Component\Router\RouteAwareInterface;
use Fabs\Component\Router\RouterMatchResult;

abstract class ApplicationBase extends Injectable implements MiddlewareAwareInterface
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
     * @param ModuleBag $module_bag
     * @return void
     */
    protected abstract function configureModuleBag($module_bag);

    /**
     * @return RequestDefinition
     */
    protected abstract function getRequestDefinition();

    /**
     * @throws NotFoundException
     */
    protected function handle()
    {
        $request_uri = $this->request->getPathInfo();

        #region routing

        // Find matching module
        $module_bag = new ModuleBag();
        $module_bag->setContainer($this->getContainer());
        $this->configureModuleBag($module_bag);
        $module_definition_list = $module_bag->getAll();
        $module_match_result = $this->getMatchingRouteAwareFromList($request_uri, $module_definition_list);
        /** @var ModuleDefinition $matched_module_definition */
        $matched_module_definition = $module_match_result->getRouteAware();
        /** @var ModuleInterface $module */
        $module = $matched_module_definition->getInstance();
        $request_uri = $module_match_result->getRestOfUri();

        // Find matching resource
        $resource_provider = $module->getResourceProvider();
        Assert::isType($resource_provider, ResourceProviderInterface::class, 'resource provider');
        $resource_bag = new ResourceBag();
        $resource_bag->setContainer($this->getContainer());
        $resource_provider->configureResourceBag($resource_bag);
        $resource_definition_list = $resource_bag->getAll();
        $resource_match_result = $this->getMatchingRouteAwareFromList($request_uri, $resource_definition_list);
        /** @var ResourceDefinition $matched_resource_definition */
        $matched_resource_definition = $resource_match_result->getRouteAware();
        /** @var ResourceInterface $resource */
        $resource = $matched_resource_definition->getInstance();
        $request_uri = $resource_match_result->getRestOfUri();

        // Find matching endpoint
        $endpoint_bag = new EndpointBag();
        $resource->configureEndpointBag($endpoint_bag);
        /** @var Endpoint[] $endpoint_list */
        $endpoint_list = $endpoint_bag->getAll();
        $endpoint_match_result = $this->getMatchingRouteAwareFromList($request_uri, $endpoint_list, true);
        /** @var Endpoint $endpoint */
        $endpoint = $endpoint_match_result->getRouteAware();
        $action_parameters = $endpoint_match_result->getParameters();

        // Find matching action
        $http_method = $this->request->getMethod();
        $matched_action = $endpoint->getAction($http_method);
        if ($matched_action === null) {
            throw new MethodNotAllowedException();
        }

        #endregion

        #region add module services to application container

        $module_service_provider = $module->getServiceProvider();
        if ($module_service_provider !== null) {
            Assert::isType(
                $module_service_provider,
                ServiceProviderInterface::class,
                'service provider'
            );

            $service_bag = new ServiceBag();
            $module_service_provider->configureServiceBag($service_bag);
            $service_definition_list = $service_bag->getAll();
            foreach ($service_definition_list as $service_definition) {
                $this->getContainer()->add($service_definition);
            }
        }

        #endregion

        #region execution

        // Execute middleware initialize
        $this->executeInitialize();
        $matched_module_definition->executeInitialize();
        $matched_resource_definition->executeInitialize();
        $matched_action->executeInitialize();

        // Execute middleware before
        $this->executeBefore();
        $matched_module_definition->executeBefore();
        $matched_resource_definition->executeBefore();
        $matched_action->executeBefore();

        // Execute action
        $output = $matched_action->execute($resource, $action_parameters);

        // Set response
        $this->response->setContent($output);

        // Execute middleware after
        $matched_action->executeAfter();
        $matched_resource_definition->executeAfter();
        $matched_module_definition->executeAfter();
        $this->executeAfter();

        // Execute middleware finalize
        $matched_action->executeFinalize();
        $matched_resource_definition->executeFinalize();
        $matched_module_definition->executeFinalize();
        $this->executeFinalize();

        #endregion
    }

    /**
     * @param string $uri
     * @param RouteAwareInterface[] $route_aware_list
     * @param bool $is_exact
     * @return RouterMatchResult
     * @throws NotFoundException
     */
    private function getMatchingRouteAwareFromList($uri, $route_aware_list, $is_exact = false)
    {
        $match_result = $this->router->match($uri, $route_aware_list, $is_exact);
        if ($match_result === null) {
            throw new NotFoundException($uri);
        }

        return $match_result;
    }

    public final function setContainer($container)
    {
        Assert::isType($container, Container::class, 'container');
        return parent::setContainer($container);
    }
}
