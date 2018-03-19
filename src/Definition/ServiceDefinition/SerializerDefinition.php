<?php

namespace Fabstract\Component\Http\Definition\ServiceDefinition;

use Fabstract\Component\DependencyInjection\ServiceDefinition;
use Fabstract\Component\Http\Constant\Services;
use Fabstract\Component\Serializer\SerializerInterface;

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
