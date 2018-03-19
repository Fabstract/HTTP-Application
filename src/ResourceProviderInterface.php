<?php

namespace Fabstract\Component\Http;

use Fabstract\Component\Http\Bag\ResourceBag;

interface ResourceProviderInterface
{
    /**
     * @param ResourceBag $resource_bag
     * @return void
     */
    public function configureResourceBag($resource_bag);
}
