<?php

namespace Fabs\Component\Http\Model;

use Fabs\Component\Serializer\Normalizer\NormalizableInterface;
use Fabs\Component\Serializer\Normalizer\NormalizationMetadata;

class ResponseModel implements NormalizableInterface
{
    /** @var string */
    public $status = null;
    /** @var array|object */
    public $data = null;

    /**
     * @param NormalizationMetadata $normalization_metadata
     * @return void
     */
    public function configureNormalizationMetadata($normalization_metadata)
    {
        // todo render if not null condition for data field
    }
}