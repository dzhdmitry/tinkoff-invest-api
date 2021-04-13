<?php

namespace Dzhdmitry\TinkoffInvestApi\Streaming\Denormalizer;

use Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Payload\Ask;
use Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Payload\Bid;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface;

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
        if (count($data) !== 2) {
            throw new InvalidArgumentException();
        }

        if (!array_key_exists(0, $data) || !array_key_exists(1, $data)) {
            throw new InvalidArgumentException();
        }

        switch ($type) {
            case Bid::class:
                $result = new Bid($data[0], $data[1]);

                break;
            case Ask::class:
                $result = new Ask($data[0], $data[1]);

                break;
            default:
                throw new UnexpectedValueException();
        }

        return $result;
    }
}
