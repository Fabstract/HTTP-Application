<?php

namespace Fabs\Component\Http;

class Action extends Injectable implements MiddlewareAwareInterface
{
    use MiddlewareAwareTrait;

    /**
     * @var callable|string
     */
    private $callable = null;

    /**
     * ActionDefinition constructor.
     * @param callable|string $callable
     */
    private function __construct($callable)
    {
        Assert::isNotNull($callable); // todo string or callable check

        $this->callable = $callable;
    }

    /**
     * @param ResourceInterface $resource
     * @param mixed[] $parameters
     * @return mixed
     */
    public function execute($resource, $parameters)
    {
        $callable = $this->callable;
        if (is_string($this->callable)) {
            Assert::isMethodExist($resource, $this->callable, 'callable');
            $callable = [$resource, $this->callable];
        }

        return $callable(...$parameters);
    }

    /**
     * @param callable|string $callable
     * @return $this
     */
    public static function create($callable)
    {
        return new static($callable);
    }
}
