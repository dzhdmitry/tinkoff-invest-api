<?php

namespace Dzhdmitry\TinkoffInvestApi\Streaming;

use Dzhdmitry\TinkoffInvestApi\NestedObjectTypeExtractor;
use Dzhdmitry\TinkoffInvestApi\Streaming\Denormalizer\BidAskDenormalizer;
use Dzhdmitry\TinkoffInvestApi\Streaming\Denormalizer\DateTimeDenormalizer;
use Dzhdmitry\TinkoffInvestApi\Streaming\Denormalizer\ResponseDenormalizer;
use Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Payload as Types;
use Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Response\CandleResponse;
use Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Response\ErrorResponse;
use Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Response\InstrumentInfoResponse;
use Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Response\OrderbookResponse;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class ResponseDeserializerFactory
{
    /**
     * @var array
     */
    private array $nestedTypes = [
        Types\Orderbook::class => [
            'bids' => Types\Bid::class,
            'asks' => Types\Ask::class,
        ],
    ];

    /**
     * @var string[]
     */
    private array $responseTypes = [
        'candle' => CandleResponse::class,
        'error' => ErrorResponse::class,
        'orderbook' => OrderbookResponse::class,
        'instrument_info' => InstrumentInfoResponse::class,
    ];

    /**
     * @return ResponseDeserializer
     */
    public function create(): ResponseDeserializer
    {
        return new ResponseDeserializer($this->createSerializer());
    }

    /**
     * @return SerializerInterface
     */
    private function createSerializer(): SerializerInterface
    {
        $propertyInfoExtractor = new PropertyInfoExtractor([], [
            new NestedObjectTypeExtractor($this->nestedTypes),
            new ReflectionExtractor(),
        ]);

        return new Serializer(
            [
                new ResponseDenormalizer($this->responseTypes),
                new BidAskDenormalizer(),
                new ArrayDenormalizer(),
                new DateTimeDenormalizer(new DateTimeNormalizer()),
                new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter(), null, $propertyInfoExtractor),
            ],
            [
                new JsonEncoder(),
            ]
        );
    }
}
