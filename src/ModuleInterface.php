<?php

namespace Fabstract\Component\Http;

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
