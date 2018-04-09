<?php

namespace Fabstract\Component\Http;

use Fabstract\Component\DependencyInjection\ServiceProviderInterface;

interface ModuleInterface
{
    /**
     * @return ResourceProviderInterface|string
     */
    public function getResourceProvider();

    /**
     * @return ServiceProviderInterface|string|null
     */
    public function getServiceProvider();
}
