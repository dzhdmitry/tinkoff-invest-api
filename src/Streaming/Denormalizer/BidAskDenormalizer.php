<?php

namespace Dzhdmitry\TinkoffInvestApi\Streaming\Denormalizer;

use Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Payload\Ask;
use Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Payload\Bid;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface;

/**
 * Десериализует массив вида [<float>, <int>] в объекты Bid или Ask
 */
class BidAskDenormalizer implements ContextAwareDenormalizerInterface
{
    /**
     * @inheritDoc
     */
    public function supportsDenormalization($data, string $type, string $format = null, array $context = [])
    {
        return in_array($type, [Bid::class, Ask::class], true) && is_array($data);
    }

    /**
     * @inheritDoc
     */
    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        if (!is_array($data)) {
            throw new InvalidArgumentException('Data expected to be an array, ' . get_debug_type($data) . ' given.');
        }

        if (count($data) !== 2) {
            throw new InvalidArgumentException('Count of data must be 2, but ' . count($data) . ' given.');
        }

        if (!array_key_exists(0, $data) || !array_key_exists(1, $data)) {
            throw new InvalidArgumentException('Data does not have required "0" and "1" keys.');
        }

        switch ($type) {
            case Bid::class:
                $result = new Bid($data[0], $data[1]);

                break;
            case Ask::class:
                $result = new Ask($data[0], $data[1]);

                break;
            default:
                throw new UnexpectedValueException('Unknown type ' . $type . ' given.');
        }

        return $result;
    }
}
