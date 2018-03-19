<?php

namespace Fabstract\Component\Http\Definition\ServiceDefinition;

use Fabstract\Component\DependencyInjection\ServiceDefinition;
use Fabstract\Component\Http\Constant\Services;
use Fabstract\Component\Router\RouterInterface;

final class RouterDefinition extends ServiceDefinition
{
    public function getName()
    {
        return Services::ROUTER;
    }

    protected function getAssertType()
    {
        return RouterInterface::class;
    }

    public function isShared()
    {
        return true;
    }
}
