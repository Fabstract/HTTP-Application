<?php

namespace Fabs\Component\Http;

use Fabs\Component\DependencyInjection\SharedDefinition;
use Fabs\Component\Http\Constant\Services;
use Fabs\Component\Http\Definition\ModuleDefinition;
use Fabs\Component\Http\Exception\StatusCodeException\NotFoundException;

abstract class Application extends Injectable
{
    public final function __construct()
    {
        $this->setContainer(new Container());

        $application_definition = new SharedDefinition();
        $application_definition->setInstance($this);
        $application_definition->setName(Services::APPLICATION);

        $this->getContainer()->add($application_definition);
    }

    /**
     * @return ModuleDefinition[]
     */
    protected abstract function getModuleDefinitionList();

    public function run()
    {
        $uri = $this->request->getPathInfo();
        $module_definition_list = $this->getModuleDefinitionList();
        // todo assert array of module definition
        $match_result = $this->router->match($uri, $module_definition_list);
        if ($match_result === null) {
            throw new NotFoundException();
        }

        // todo run a method inside RouteAwareInterface or something. I dont know man, this is a fucking module, now what?
    }
}
