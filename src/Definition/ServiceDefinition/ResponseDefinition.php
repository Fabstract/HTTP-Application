<?php

namespace Fabs\Component\Http\Definition\ServiceDefinition;

use Fabs\Component\DependencyInjection\ServiceDefinition;
use Fabs\Component\Http\Constant\Services;
use Fabs\Component\Http\Response;

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
