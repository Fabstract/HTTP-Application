<?php

namespace Fabs\Component\Http\Middleware;

use Fabs\Component\Http\Assert;
use Fabs\Component\Http\MiddlewareBase;
use Fabs\Component\Serializer\Normalizer\Type;

class NormalizationMiddleware extends MiddlewareBase
{
    /** @var Type */
    private $type = null;

    function __construct($type)
    {
        Assert::isType($type, Type::class, 'type');
        $this->type = $type;
    }

    public function before()
    {
        if (isset($this->serializer)) {
            $normalized = $this->serializer->getNormalizer()->denormalize(
                $this->request->getBody(),
                $this->type
            );

            $this->request->setBody($normalized);
        }
    }
}
