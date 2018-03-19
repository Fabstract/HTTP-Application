<?php

namespace Fabstract\Component\Http;

use Fabstract\Component\DependencyInjection\ContainerAwareInterface;

class Action extends Injectable implements MiddlewareAwareInterface
{
    use MiddlewareAwareTrait;

    /**
     * @var callable|string
     */
    private $callable = null;

    /**
     * ActionDefinition constructor.
     * @param ContainerAwareInterface $container_aware
     * @param callable|string $callable
     */
    private function __construct($container_aware, $callable)
    {
        Assert::isType($container_aware, ContainerAwareInterface::class, 'container_aware');
        Assert::isNotNull($callable, 'callable'); // todo string or callable check

        $this->setContainer($container_aware->getContainer());
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
            Assert::isMethodExists($resource, $this->callable);
            $callable = [$resource, $this->callable];
        }

        return $callable(...$parameters);
    }

    /**
     * @param ContainerAwareInterface $container_aware
     * @param callable|string $callable
     * @return $this
     */
    public static function create($container_aware, $callable)
    {
        return new static($container_aware, $callable);
    }
}
