<?php

namespace Fabstract\Component\Http\Definition\ServiceDefinition;

use Fabstract\Component\DependencyInjection\ServiceDefinition;
use Fabstract\Component\Http\Constant\Services;
use Fabstract\Component\Http\Response;

final class ResponseDefinition extends ServiceDefinition
{
    public function getName()
    {
        return Services::RESPONSE;
    }

    protected function getAssertType()
    {
        return Response::class; // todo change to interface
    }

    public function isShared()
    {
        return true;
    }
}
