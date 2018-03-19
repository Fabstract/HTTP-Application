<?php

namespace Fabstract\Component\Http;

interface ModuleInterface
{
    /**
     * @return ResourceProviderInterface|string
     */
    public function getResourceProvider();

    /**
     * @return ServiceProviderInterface|null
     */
    public function getServiceProvider();
}
