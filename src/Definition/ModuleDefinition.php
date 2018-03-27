<?php

namespace Fabstract\Component\Http\Definition;

use Fabstract\Component\Http\ModuleInterface;

class ModuleDefinition extends RouteAwareDefinition
{
    protected function getAssertType()
    {
        return ModuleInterface::class;
    }
}
