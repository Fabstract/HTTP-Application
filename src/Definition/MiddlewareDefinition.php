<?php

namespace Fabstract\Component\Http\Definition;

use Fabstract\Component\DependencyInjection\Definition;
use Fabstract\Component\Http\MiddlewareInterface;

class MiddlewareDefinition extends Definition
{
    protected final function getAssertType()
    {
        return MiddlewareInterface::class;
    }
}
