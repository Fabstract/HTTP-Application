<?php

namespace Fabs\Component\Http\Definition\ServiceDefinition;

use Fabs\Component\DependencyInjection\ServiceDefinition;
use Fabs\Component\Http\Constant\Services;
use Fabs\Component\Router\RouterInterface;

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
