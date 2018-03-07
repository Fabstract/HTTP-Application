<?php

namespace Fabs\Component\Http;

use Fabs\Component\DependencyInjection\DefinitionAwareInterface;
use Fabs\Component\Http\Bag\ResourceBag;

interface ResourceProviderInterface extends DefinitionAwareInterface
{
    /**
     * @param ResourceBag $resource_bag
     * @return void
     */
    public function configureResourceBag($resource_bag);
}
