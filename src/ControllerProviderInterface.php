<?php

namespace Fabstract\Component\Http;

use Fabstract\Component\Http\Bag\ControllerBag;

interface ControllerProviderInterface
{
    /**
     * @param ControllerBag $controller_bag
     * @return void
     */
    public function configureControllerBag($controller_bag);
}
