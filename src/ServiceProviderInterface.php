<?php

namespace Fabstract\Component\Http;

use Fabstract\Component\Http\Bag\ServiceBag;

interface ServiceProviderInterface
{
    /**
     * @param ServiceBag $service_bag
     * @return void
     */
    public function configureServiceBag($service_bag);
}
