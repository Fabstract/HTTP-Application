<?php

namespace Fabstract\Component\Http;

use Fabstract\Component\Http\Bag\ResourceBag;

/**
 * Interface ResourceProviderInterface
 * @package Fabstract\Component\Http
 *
 * @deprecated Use ControllerProviderInterface instead.
 * @see ControllerProviderInterface
 */
interface ResourceProviderInterface
{
    /**
     * @param ResourceBag $resource_bag
     * @return void
     */
    public function configureResourceBag($resource_bag);
}
