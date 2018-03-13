<?php

namespace Fabs\Component\Http;

use Fabs\Component\Http\Definition\ServiceDefinition\RequestDefinition;

abstract class HttpApplicationBase extends ApplicationBase
{
    protected function getRequestDefinition()
    {
        $request_definition = new RequestDefinition();
        $request_definition->setCreator(function () {
            return Request::createFromGlobals();
        });

        return $request_definition;
    }

    /**
     * @return void
     */
    public function run()
    {
        $this->handle();
        $this->response->send();
    }
}
