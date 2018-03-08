<?php

namespace Fabs\Component\Http;

use Fabs\Component\Http\Bag\ServiceBag;

interface ServiceProviderInterface
{
    /**
     * @param ServiceBag $service_bag
     * @return void
     */
    public function configureServiceBag($service_bag);
}
