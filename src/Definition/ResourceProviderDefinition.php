<?php

namespace Fabstract\Component\Http\Definition;

use Fabstract\Component\DependencyInjection\Definition;
use Fabstract\Component\Http\ResourceProviderInterface;

/**
 * Class ResourceProviderDefinition
 * @package Fabstract\Component\Http\Definition
 *
 * @deprecated Use ControllerProviderDefinition instead.
 * @see ControllerProviderDefinition
 */
class ResourceProviderDefinition extends Definition
{
    protected final function getAssertType()
    {
        return ResourceProviderInterface::class;
    }
}
