<?php

namespace Fabs\Component\Http\Definition;

use Fabs\Component\Http\ResourceInterface;

class ResourceDefinition extends RouteAwareDefinition
{
    protected final function getAssertType()
    {
        return ResourceInterface::class;
    }
}
