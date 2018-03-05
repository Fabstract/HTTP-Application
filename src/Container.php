<?php

namespace Fabs\Component\Http;


use Fabs\Component\DependencyInjection\SharedDefinition;
use Fabs\Component\Http\Constant\Services;
use Fabs\Component\Router\Router;
use Symfony\Component\HttpFoundation\Request;

class Container extends \Fabs\Component\DependencyInjection\Container
{
    public function __construct()
    {
        foreach ($this->getServices() as $service) {
            $this->add($service);
        }
    }

    private function getServices()
    {
        $router_definition = new SharedDefinition();
        $router_definition->setName(Services::ROUTER);
        $router_definition->setCreator(function () {
            $router = new Router();
            $router->defineShortcut('#int', '(\d+)');
            return $router;
        });

        yield $router_definition;

        $request_definition = new SharedDefinition();
        $request_definition->setName(Services::REQUEST);
        $request_definition->setCreator(function () {
            return Request::createFromGlobals();
        });

        yield $request_definition;
    }
}
