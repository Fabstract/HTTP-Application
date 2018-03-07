<?php

namespace Fabs\Component\Http\Definition;

use Fabs\Component\Http\ResourceProviderInterface;

class ResourceProviderDefinition extends RouteAwareDefinition
{
    protected final function getAssertType()
    {
        return ResourceProviderInterface::class;
    }
}
