<?php

namespace Dzhdmitry\TinkoffInvestApi\Streaming;

use Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Response\AbstractResponse;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class ResponseDeserializer
{
    /**
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;

    /**
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param string $message
     *
     * @return array|object
     */
    public function deserializeResponse(string $message)
    {
        return $this->serializer->deserialize($message, AbstractResponse::class, 'json', [
            DateTimeNormalizer::FORMAT_KEY => 'Y-m-d\TH:i:s.u+',
        ]);
    }
}
