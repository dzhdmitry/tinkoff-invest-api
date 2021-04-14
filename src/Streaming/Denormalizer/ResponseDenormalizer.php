<?php

namespace Dzhdmitry\TinkoffInvestApi\Streaming\Denormalizer;

use Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Response\AbstractResponse;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerAwareTrait;

/**
 * Десериализует ассоциативныймассив в один из объектов, унаследованных от AbstractResponse.
 * Класс обекта определяет по полю "event" массива
 */
class ResponseDenormalizer implements ContextAwareDenormalizerInterface, SerializerAwareInterface
{
    use SerializerAwareTrait;

    /**
     * @var string[]
     */
    private array $responseTypes;

    /**
     * @param string[] $responseTypes
     */
    public function __construct($responseTypes)
    {
        $this->responseTypes = $responseTypes;
    }

    /**
     * @inheritDoc
     */
    public function supportsDenormalization($data, string $type, string $format = null, array $context = [])
    {
        return $type === AbstractResponse::class &&
            is_array($data) &&
            array_key_exists('event', $data);
    }

    /**
     * @inheritDoc
     */
    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        if (!is_array($data)) {
            throw new InvalidArgumentException('Data expected to be an array, ' . get_debug_type($data) . ' given.');
        }

        if (!array_key_exists($data['event'], $this->responseTypes)) {
            throw new UnexpectedValueException('Data has unknown event type ' . $data['event']);
        }

        return $this->serializer->denormalize($data, $this->responseTypes[$data['event']], $format, $context);
    }
}
