<?php

namespace Fabs\Component\Http;

use Fabs\Component\Http\Bag\ResourceBag;

interface ResourceProviderInterface
{
    /**
     * @param ResourceBag $resource_bag
     * @return void
     */
    public function configureResourceBag($resource_bag);
}
