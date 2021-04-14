<?php

namespace Dzhdmitry\TinkoffInvestApi\Streaming\Denormalizer;

use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Обертка над DateTimeNormalizer.
 * Десериализует даты в обект \DateTimeInterface,
 * которые могут быть в форматах RFC3339Nano "2021-04-14T08:13:21.972670108Z" и RFC3339 "2021-04-14T08:13:00Z"
 */
class DateTimeDenormalizer implements DenormalizerInterface
{
    public const DATE_FORMAT_RFC3339_NANO = 'Y-m-d\TH:i:s.u+';

    /**
     * @var DateTimeNormalizer
     */
    private DateTimeNormalizer $normalizer;

    /**
     * @param DateTimeNormalizer $normalizer
     */
    public function __construct(DateTimeNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    /**
     * @inheritDoc
     */
    public function supportsDenormalization($data, string $type, string $format = null)
    {
        return $this->normalizer->supportsDenormalization($data, $type, $format);
    }

    /**
     * @inheritDoc
     */
    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        $context[DateTimeNormalizer::FORMAT_KEY] = self::DATE_FORMAT_RFC3339_NANO;

        if (preg_match('/:\d{2}Z$/', $data)) {
            $context[DateTimeNormalizer::FORMAT_KEY] = DATE_RFC3339;
        }

        return $this->normalizer->denormalize($data, $type, $format, $context);
    }
}
