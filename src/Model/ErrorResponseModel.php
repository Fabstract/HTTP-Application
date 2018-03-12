<?php

namespace Fabs\Component\Http\Model;

class ErrorResponseModel extends ResponseModel
{
    /** @var string */
    public $error_message = null;
    /** @var null|object */
    public $error_details = null;

    public function configureNormalizationMetadata($normalization_metadata)
    {
        parent::configureNormalizationMetadata($normalization_metadata);

        // todo render if not null for error_msg and details
    }
}