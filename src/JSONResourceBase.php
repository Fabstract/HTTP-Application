<?php

namespace Fabs\Component\Http;

use Fabs\Component\Http\Exception\StatusCodeException\BadRequestException;
use Fabs\Component\Serializer\Exception\JSONParseException;
use Fabs\Component\Serializer\JSONSerializer;
use Fabs\Component\Serializer\Normalizer\Type;

abstract class JSONResourceBase extends ResourceBase
{
    /**
     * @param Type|null $type
     * @return resource|string
     * @throws BadRequestException
     */
    protected function getRequestContent($type = null)
    {
        if ($type === null) {
            return $this->request->getContent();
        } else {
            Assert::isType($this->serializer, JSONSerializer::class, 'serializer');
            Assert::isType($type, Type::class, 'type');

            try {
                return $this->serializer->deserialize($this->request->getContent(), $type);
            } catch (JSONParseException $exception) {
                throw new BadRequestException();
            }
        }
    }
}