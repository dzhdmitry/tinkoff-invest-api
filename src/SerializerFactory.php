<?php

namespace Dzhdmitry\TinkoffInvestApi;

use Dzhdmitry\TinkoffInvestApi\Schema\Payload as Types;
use Dzhdmitry\TinkoffInvestApi\Schema\Response\OrdersResponse;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class SerializerFactory
{
    /**
     * @var array
     */
    private array $nestedTypes = [
        Types\Candles::class => [
            'candles' => Types\Candle::class,
        ],
        Types\Currencies::class => [
            'currencies' => Types\CurrencyPosition::class,
        ],
        Types\MarketInstrumentList::class => [
            'instruments' => Types\MarketInstrument::class,
        ],
        Types\Operation::class => [
            'trades' => Types\OperationTrade::class,
        ],
        Types\Operations::class => [
            'operations' => Types\Operation::class,
        ],
        Types\Orderbook::class => [
            'bids' => Types\OrderResponse::class,
            'asks' => Types\OrderResponse::class,
        ],
        OrdersResponse::class => [
            'payload' => Types\Order::class,
        ],
        Types\Portfolio::class => [
            'positions' => Types\PortfolioPosition::class,
        ],
        Types\UserAccounts::class => [
            'accounts' => Types\Account::class,
        ],
    ];

    /**
     * @return SerializerInterface
     */
    public function create(): SerializerInterface
    {
        $propertyInfoExtractor = new PropertyInfoExtractor([], [
            new NestedObjectTypeExtractor($this->nestedTypes),
            new ReflectionExtractor(),
        ]);

        return new Serializer(
            [
                new ArrayDenormalizer(),
                new DateTimeNormalizer(),
                new ObjectNormalizer(null, null, null, $propertyInfoExtractor),
            ],
            [
                new JsonEncoder(),
            ]
        );
    }
}
