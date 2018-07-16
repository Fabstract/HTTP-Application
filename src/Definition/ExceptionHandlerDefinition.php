<?php

namespace Fabstract\Component\Http\Definition;

use Fabstract\Component\DependencyInjection\Definition;
use Fabstract\Component\Http\Assert;
use Fabstract\Component\Http\ExceptionHandlerInterface;

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

    /**
     * @param string $exception_type
     * @return ExceptionHandlerDefinition
     */
    public static function create($exception_type)
    {
        return new static($exception_type);
    }
}
