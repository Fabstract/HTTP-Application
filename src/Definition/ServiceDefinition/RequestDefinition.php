<?php

namespace Fabstract\Component\Http\Definition\ServiceDefinition;

use Fabstract\Component\DependencyInjection\ServiceDefinition;
use Fabstract\Component\Http\Constant\Services;
use Fabstract\Component\Http\Request;

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
