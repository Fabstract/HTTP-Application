<?php

namespace Fabs\Component\Http;

use Fabs\Component\DependencyInjection\Definition;
use Fabs\Component\DependencyInjection\DefinitionAwareInterface;

class DefinitionAwareInjectable extends Injectable implements DefinitionAwareInterface
{
    /**
     * @var Definition
     */
    private $definition = null;

    /**
     * @return Definition
     */
    public function getDefinition()
    {
        return $this->definition;
    }

    /**
     * @param Definition $definition
     * @return $this
     */
    public function setDefinition($definition)
    {
        $this->definition = $definition;
        return $this;
    }
}
