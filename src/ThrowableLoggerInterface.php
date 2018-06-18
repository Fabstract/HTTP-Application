<?php

namespace Fabstract\Component\Http;

interface ThrowableLoggerInterface
{
    /**
     * @param \Throwable $throwable
     * @return void
     */
    public function logThrowable($throwable);
}
