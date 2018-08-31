<?php

namespace Fabstract\Component\Http;

use Fabstract\Component\DependencyInjection\ServiceDefinition;
use Fabstract\Component\Http\Constant\Services;
use Fabstract\Component\Http\Definition\ServiceDefinition\RequestDefinition;
use Fabstract\Component\Http\ExceptionHandler\GeneralExceptionHandler;
use Fabstract\Component\Http\ExceptionHandler\LoggingGeneralExceptionHandler;
use Fabstract\Component\Http\Middleware\AccessControlMiddleware;

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
     * @return void
     */
    protected function onConstruct($app_config = null)
    {
        if ($app_config !== null) {
            if ($app_config->isExceptionLoggerEnabled()) {
                $this->getContainer()->add(
                    (new ServiceDefinition())
                        ->setName(Services::EXCEPTION_LOGGER)
                        ->setShared(true)
                        ->setClassName(SimpleExceptionLoggerService::class));

                $this->addExceptionHandler(\Exception::class, LoggingGeneralExceptionHandler::class);
            } else {
                $this->addExceptionHandler(\Exception::class, GeneralExceptionHandler::class);
            }

            if ($app_config->getAccessControlSettings() !== null) {
                $this->addMiddleware(AccessControlMiddleware::class);
            }
        }
    }

    /**
     * @return void
     * @throws Exception\StatusCodeException\MethodNotAllowedException
     * @throws Exception\StatusCodeException\NotFoundException
     */
    public function run()
    {
        $this->handle();
        $this->response
            ->prepare($this->request)
            ->send();
    }
}
