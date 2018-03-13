<?php

namespace Fabs\Component\Http\Definition;

use Fabs\Component\DependencyInjection\Definition;
use Fabs\Component\Http\ServiceProviderInterface;

class ServiceProviderDefinition extends Definition
{
    protected final function getAssertType()
    {
        return ServiceProviderInterface::class;
    }
}
