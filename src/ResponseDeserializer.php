<?php

namespace Dzhdmitry\TinkoffInvestApi;

use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @link https://symfony.com/doc/current/components/serializer.html
 */
class ResponseDeserializer
{
    private const FORMAT = 'json';

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
     * @param array $nestedTypes
     *
     * @return ResponseDeserializer
     */
    public static function create(array $nestedTypes = []): ResponseDeserializer
    {
        $propertyInfoExtractor = new PropertyInfoExtractor([], [
            new NestedObjectTypeExtractor($nestedTypes),
            new ReflectionExtractor(),
        ]);
        $serializer = new Serializer(
            [
                new ArrayDenormalizer(),
                new DateTimeNormalizer(),
                new ObjectNormalizer(null, null, null, $propertyInfoExtractor),
            ],
            [
                new JsonEncoder(),
            ]
        );

        return new self($serializer);
    }

    /**
     * @param string $data
     * @param string $type
     *
     * @return mixed
     */
    public function deserialize(string $data, string $type)
    {
        return $this->serializer->deserialize($data, $type, self::FORMAT);
    }
}
