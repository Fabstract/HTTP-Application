<?php

namespace Fabs\Component\Http;

interface ModuleInterface
{

    /**
     * @return ResourceProviderInterface
     */
    public function getResourceProvider();

    /**
     * @return ServiceProviderInterface|null
     */
    public function getServiceProvider();
}