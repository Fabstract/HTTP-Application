<?php

namespace Fabstract\Component\Http;

use Fabstract\Component\DependencyInjection\ServiceProviderInterface;

interface ModuleInterface
{
    /**
     * @return ControllerProviderInterface|string
     */
    public function getControllerProvider();

    /**
     * @return ServiceProviderInterface|string|null
     */
    public function getServiceProvider();
}
