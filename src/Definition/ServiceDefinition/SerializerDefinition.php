<?php

namespace Fabs\Component\Http\Definition\ServiceDefinition;

use Fabs\Component\DependencyInjection\ServiceDefinition;
use Fabs\Component\Http\Constant\Services;
use Fabs\Component\Serializer\SerializerInterface;

final class SerializerDefinition extends ServiceDefinition
{
    public function getName()
    {
        return Services::SERIALIZER;
    }

    protected function getAssertType()
    {
        return SerializerInterface::class;
    }

    public function isShared()
    {
        return true;
    }
}
