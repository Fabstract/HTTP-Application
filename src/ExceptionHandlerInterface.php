<?php

namespace Fabs\Component\Http;

interface ExceptionHandlerInterface
{
    /**
     * @param \Exception $exception
     */
    public function handle($exception);
}