<?php

namespace Fabstract\Component\Http\Definition;

use Fabstract\Component\DependencyInjection\Definition;
use Fabstract\Component\Http\ControllerProviderInterface;

class ControllerProviderDefinition extends Definition
{
    protected final function getAssertType()
    {
        return ControllerProviderInterface::class;
    }
}
