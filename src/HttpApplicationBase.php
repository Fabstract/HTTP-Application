<?php

namespace Fabs\Component\Http;

use Fabs\Component\DependencyInjection\ServiceDefinition;
use Fabs\Component\Http\Constant\Services;
use Fabs\Component\Http\Definition\ServiceDefinition\RequestDefinition;
use Fabs\Component\Http\ExceptionHandler\GeneralExceptionHandler;

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

    protected function onConstruct()
    {
        $this->addExceptionHandler(\Exception::class, GeneralExceptionHandler::class);

        $this->getContainer()->add(
            (new ServiceDefinition(true))
                ->setName(Services::EXCEPTION_LOGGER)
                ->setClassName(ExceptionLoggerService::class));
    }

    /**
     * @return void
     */
    public function run()
    {
        $this->handle();
        $this->response
            ->prepare($this->request)
            ->send();
    }
}
