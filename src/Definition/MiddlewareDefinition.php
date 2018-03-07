<?php

namespace Fabs\Component\Http\Definition;

use Fabs\Component\DependencyInjection\Definition;
use Fabs\Component\Http\MiddlewareInterface;

class MiddlewareDefinition extends Definition
{
    protected final function getAssertType()
    {
        return MiddlewareInterface::class;
    }
}
