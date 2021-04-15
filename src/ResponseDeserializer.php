<?php

namespace Dzhdmitry\TinkoffInvestApi;

use Psr\Http\Message\ResponseInterface;
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
     * @param ResponseInterface $response
     * @param string $responseClass
     *
     * @return mixed
     */
    public function deserialize(ResponseInterface $response, string $responseClass)
    {
        return $this->serializer->deserialize(
            $response->getBody()->getContents(),
            $responseClass,
            self::RESPONSE_FORMAT
        );
    }
}
