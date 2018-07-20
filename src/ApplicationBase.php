<?php

namespace Fabstract\Component\Http;

use Fabstract\Component\DependencyInjection\ServiceDefinition;
use Fabstract\Component\DependencyInjection\ServiceProviderInterface;
use Fabstract\Component\Http\Bag\EndpointBag;
use Fabstract\Component\Http\Bag\ModuleBag;
use Fabstract\Component\Http\Bag\ControllerBag;
use Fabstract\Component\Http\Constant\HttpMethods;
use Fabstract\Component\Http\Constant\Services;
use Fabstract\Component\Http\Definition\ExceptionHandlerDefinition;
use Fabstract\Component\Http\Definition\ModuleDefinition;
use Fabstract\Component\Http\Definition\ControllerDefinition;
use Fabstract\Component\Http\Definition\ServiceDefinition\RequestDefinition;
use Fabstract\Component\Http\Exception\StatusCodeException\MethodNotAllowedException;
use Fabstract\Component\Http\Exception\StatusCodeException\NotFoundException;
use Fabstract\Component\Router\RouteAwareInterface;
use Fabstract\Component\Router\RouterMatchResult;

abstract class ApplicationBase extends Injectable implements MiddlewareAwareInterface
{
    use MiddlewareAwareTrait;

    /** @var ExceptionHandlerDefinition[] */
    private $exception_handler_definition_list = [];
    /** @var int */
    private $current_exception_depth = 1;
    /** @var ApplicationConfig */
    private $application_config = null;
    /** @var ModuleInterface */
    private $matched_module = null;
    /** @var ControllerInterface */
    private $matched_controller = null;

    /** @var int */
    const DEFAULT_MAXIMUM_ALLOWED_EXCEPTION_DEPTH = 15; /* should use "private const" when switching to PHP 7.1 */

    /**
     * ApplicationBase constructor.
     * @param ApplicationConfig $app_config
     */
    public final function __construct($app_config = null)
    {
        $this->setupExceptionHandling();

        $this->setContainer(new Container($this->getRequestDefinition()));

        $application_definition = new ServiceDefinition();
        $application_definition->setInstance($this)
            ->setShared(true)
            ->setName(Services::APPLICATION);

        $this->getContainer()->add($application_definition);

        if ($app_config !== null) {
            Assert::isType($app_config, ApplicationConfig::class, 'app_config');
            $this->application_config = $app_config;

            $this->getContainer()->add(
                (new ServiceDefinition())
                    ->setShared(true)
                    ->setInstance($app_config)
                    ->setName(Services::APPLICATION_CONFIG));
        }

        $this->onConstruct($app_config);
    }

    /**
     * @param Container $container
     * @return $this
     */
    public final function setContainer($container)
    {
        Assert::isType($container, Container::class, 'container');
        parent::setContainer($container);
        return $this;
    }

    /**
     * @return Container
     */
    public function getContainer()
    {
        /** @var Container $container */
        $container = parent::getContainer();
        return $container;
    }

    /**
     * @param string $exception_type
     * @param string $handler_class
     * @return $this
     */
    public function addExceptionHandler($exception_type, $handler_class)
    {
        $definition = new ExceptionHandlerDefinition($exception_type);
        $definition->setClassName($handler_class);
        return $this->addExceptionHandlerDefinition($definition);
    }

    /**
     * @param ExceptionHandlerDefinition $exception_handler_definition
     * @return $this
     */
    public function addExceptionHandlerDefinition($exception_handler_definition)
    {
        Assert::isType(
            $exception_handler_definition,
            ExceptionHandlerDefinition::class,
            'exception handler definition'
        );

        $exception_handler_definition->setContainer($this->getContainer());
        $this->exception_handler_definition_list[] = $exception_handler_definition;
        return $this;
    }

    /**
     * @param \Exception $exception
     * @throws \Exception
     */
    public function handleException($exception)
    {
        try {
            foreach ($this->exception_handler_definition_list as $definition) {
                $handling_type = $definition->getExceptionType();
                if ($exception instanceof $handling_type) {
                    $handler = $definition->getInstance();
                    $handler->handle($exception);
                    return;
                }
            }
        } catch (\Exception $new_exception) {
            if ($this->current_exception_depth < static::getMaximumAllowedExceptionDepth()) {
                $this->current_exception_depth++;
                $this->handleException($new_exception);
                return;
            }
            $exception = $new_exception;
        }

        throw $exception;
    }

    /**
     * @return void
     */
    public abstract function run();

    /**
     * @param ApplicationConfig $app_config
     * @return void
     */
    protected function onConstruct($app_config = null)
    {
    }

    /**
     * @return void
     */
    protected function setupExceptionHandling()
    {
        set_error_handler(function ($error_no, $error_message, $error_file, $error_line) {
            throw new \ErrorException($error_message, 0, $error_no, $error_file, $error_line);
        });

        set_exception_handler([$this, 'handleException']);
    }

    /**
     * @return int
     */
    protected function getMaximumAllowedExceptionDepth()
    {
        return self::DEFAULT_MAXIMUM_ALLOWED_EXCEPTION_DEPTH;
    }

    /**
     * @throws NotFoundException
     * @throws MethodNotAllowedException
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
        $this->setMatchedModule($module);
        $request_uri = $module_match_result->getRestOfUri();

        // Find matching controller
        $controller_provider = $module->getControllerProvider();
        Assert::isType($controller_provider, ControllerProviderInterface::class, 'controller provider');
        if (is_string($controller_provider)) {
            $controller_provider = new $controller_provider();
        }
        $controller_bag = new ControllerBag();
        $controller_bag->setContainer($this->getContainer());
        $controller_provider->configureControllerBag($controller_bag);
        $controller_definition_list = $controller_bag->getAll();
        $controller_match_result = $this->getMatchingRouteAwareFromList($request_uri, $controller_definition_list);
        /** @var ControllerDefinition $matched_controller_definition */
        $matched_controller_definition = $controller_match_result->getRouteAware();
        /** @var ControllerInterface $controller */
        $controller = $matched_controller_definition->getInstance();
        $this->setMatchedController($controller);
        $request_uri = $controller_match_result->getRestOfUri();

        // Find matching endpoint
        $endpoint_bag = new EndpointBag();
        $endpoint_bag->setContainer($this->getContainer());
        $controller->configureEndpointBag($endpoint_bag);
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
            if ($http_method === HttpMethods::OPTIONS &&
                $this->application_config !== null &&
                $this->application_config->getAutoAllowHttpOptions()
            ) {
                $matched_action = Action::create($endpoint, function () {
                    return [];
                });
            } else {
                throw new MethodNotAllowedException();
            }
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

            if (is_string($module_service_provider)) {
                /** @var ServiceProviderInterface $module_service_provider */
                $module_service_provider = new $module_service_provider();
            }

            /** @var \Fabstract\Component\DependencyInjection\Container $container */
            $container = $this->getContainer();
            $container->importFromServiceProvider($module_service_provider);
        }

        #endregion

        #region execution

        // Execute middleware initialize
        $this->executeInitialize();
        $matched_module_definition->executeInitialize();
        $matched_controller_definition->executeInitialize();
        $matched_action->executeInitialize();

        // Execute middleware before
        $this->executeBefore();
        $matched_module_definition->executeBefore();
        $matched_controller_definition->executeBefore();
        $matched_action->executeBefore();

        // Execute action
        $output = $matched_action->execute($controller, $action_parameters);

        // Set response's returned value
        $this->response->setReturnedValue($output);

        // Execute middleware after
        $matched_action->executeAfter();
        $matched_controller_definition->executeAfter();
        $matched_module_definition->executeAfter();
        $this->executeAfter();

        // Execute middleware finalize
        $matched_action->executeFinalize();
        $matched_controller_definition->executeFinalize();
        $matched_module_definition->executeFinalize();
        $this->executeFinalize();

        // Set response's content which was most likely overriden by middlewares and ready to be sent.
        $this->response->setContent($this->response->getReturnedValue());

        #endregion
    }

    /**
     * @return ModuleInterface
     */
    protected function getMatchedModule()
    {
        return $this->matched_module;
    }

    /**
     * @param ModuleInterface $matched_module
     * @return ApplicationBase
     */
    protected function setMatchedModule($matched_module)
    {
        $this->matched_module = $matched_module;
        return $this;
    }

    /**
     * @return ControllerInterface
     */
    protected function getMatchedController()
    {
        return $this->matched_controller;
    }

    /**
     * @param ControllerInterface $matched_controller
     * @return ApplicationBase
     */
    protected function setMatchedController($matched_controller)
    {
        $this->matched_controller = $matched_controller;
        return $this;
    }

    /**
     * @return RequestDefinition
     */
    protected abstract function getRequestDefinition();

    /**
     * @param ModuleBag $module_bag
     * @return void
     */
    protected abstract function configureModuleBag($module_bag);

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
            throw new NotFoundException();
        }

        return $match_result;
    }
}
