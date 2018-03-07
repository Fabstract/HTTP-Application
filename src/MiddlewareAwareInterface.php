<?php

namespace Fabs\Component\Http;

use Fabs\Component\Http\Definition\MiddlewareDefinition;

interface MiddlewareAwareInterface
{
    /**
     * @param MiddlewareDefinition $middleware_definition
     * @return $this
     */
    public function addMiddlewareDefinition($middleware_definition);

    /**
     * @return void
     */
    public function executeInitialize();
    /**
     * @return void
     */
    public function executeBefore();
    /**
     * @return void
     */
    public function executeAfter();
    /**
     * @return void
     */
    public function executeFinalize();
}
