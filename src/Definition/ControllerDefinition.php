<?php

namespace Fabstract\Component\Http\Definition;

use Fabstract\Component\Http\ControllerInterface;

class ControllerDefinition extends RouteAwareDefinition
{
    protected final function getAssertType()
    {
        return ControllerInterface::class;
    }
}
