<?php

namespace Fabstract\Component\Http\Definition;

use Fabstract\Component\DependencyInjection\Definition;
use Fabstract\Component\Http\ServiceProviderInterface;

class ServiceProviderDefinition extends Definition
{
    protected final function getAssertType()
    {
        return ServiceProviderInterface::class;
    }
}
