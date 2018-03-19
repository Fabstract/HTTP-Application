<?php

namespace Fabstract\Component\Http\Definition;

use Fabstract\Component\Http\ResourceInterface;

class ResourceDefinition extends RouteAwareDefinition
{
    protected final function getAssertType()
    {
        return ResourceInterface::class;
    }
}
