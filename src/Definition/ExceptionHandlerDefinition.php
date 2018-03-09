<?php

namespace Fabs\Component\Http\Definition;

use Fabs\Component\DependencyInjection\Definition;
use Fabs\Component\Http\Assert;
use Fabs\Component\Http\ExceptionHandlerInterface;

class ExceptionHandlerDefinition extends Definition
{
    /** @var string */
    private $exception_type = null;

    /**
     * ExceptionHandlerDefinition constructor.
     * @param string $exception_type
     */
    function __construct($exception_type)
    {
        Assert::isTypeExists($exception_type);

        $this->exception_type = $exception_type;
    }

    /**
     * @return string
     */
    public function getExceptionType()
    {
        return $this->exception_type;
    }

    protected function getAssertType()
    {
        return ExceptionHandlerInterface::class;
    }

    /**
     * @return ExceptionHandlerInterface
     */
    public function getInstance()
    {
        return parent::getInstance();
    }
}