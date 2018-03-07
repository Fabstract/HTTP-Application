<?php

namespace Fabs\Component\Http\Definition\ServiceDefinition;

use Fabs\Component\DependencyInjection\ServiceDefinition;
use Fabs\Component\Http\Constant\Services;
use Symfony\Component\HttpFoundation\Request;

final class RequestDefinition extends ServiceDefinition
{
    public function getName()
    {
        return Services::REQUEST;
    }

    protected function getAssertType()
    {
        return Request::class; // todo change to interface
    }

    public function isShared()
    {
        return true;
    }
}
