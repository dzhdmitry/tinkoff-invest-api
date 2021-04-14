<?php

namespace Dzhdmitry\TinkoffInvestApi\Streaming;

use Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Response\AbstractResponse;
use Symfony\Component\Serializer\SerializerInterface;

class ResponseDeserializer
{
    private const RESPONSE_FORMAT = 'json';

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
    public function deserialize(string $message)
    {
        return $this->serializer->deserialize($message, AbstractResponse::class, self::RESPONSE_FORMAT);
    }
}
