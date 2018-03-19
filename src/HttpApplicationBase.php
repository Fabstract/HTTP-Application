<?php

namespace Fabstract\Component\Http;

use Fabstract\Component\DependencyInjection\ServiceDefinition;
use Fabstract\Component\Http\Constant\Services;
use Fabstract\Component\Http\Definition\ServiceDefinition\RequestDefinition;
use Fabstract\Component\Http\ExceptionHandler\GeneralExceptionHandler;
use Fabstract\Component\Http\ExceptionHandler\LoggingGeneralExceptionHandler;

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
     * @param ApplicationConfig|null $app_config
     */
    protected function onConstruct($app_config = null)
    {
        if ($app_config !== null) {
            if ($app_config->isExceptionLoggerEnabled()) {
                $this->getContainer()->add(
                    (new ServiceDefinition(true))
                        ->setName(Services::EXCEPTION_LOGGER)
                        ->setClassName(ExceptionLoggerService::class));

                $this->addExceptionHandler(\Exception::class, LoggingGeneralExceptionHandler::class);
            } else {
                $this->addExceptionHandler(\Exception::class, GeneralExceptionHandler::class);
            }
        }
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
