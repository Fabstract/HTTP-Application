<?php

namespace Fabstract\Component\Http\Definition;

use Fabstract\Component\Http\ResourceInterface;

/**
 * Class ResourceDefinition
 * @package Fabstract\Component\Http\Definition
 *
 * @deprecated Use ControllerDefinition instead.
 * @see ControllerDefinition
 */
class ResourceDefinition extends RouteAwareDefinition
{
    protected final function getAssertType()
    {
        return ResourceInterface::class;
    }
}
