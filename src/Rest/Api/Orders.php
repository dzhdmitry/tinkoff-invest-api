<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest\Api;

use Dzhdmitry\TinkoffInvestApi\Rest\ResponseDeserializer;
use Dzhdmitry\TinkoffInvestApi\Rest\Client;
use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Response\EmptyResponse;
use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Response\LimitOrderResponse;
use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Response\MarketOrderResponse;
use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Response\OrdersResponse;
use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Request\LimitOrderRequest;
use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Request\MarketOrderRequest;
use GuzzleHttp\Exception\GuzzleException;

/**
 * https://tinkoffcreditsystems.github.io/invest-openapi/swagger-ui/#/orders
 */
class Orders
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * @var ResponseDeserializer
     */
    private ResponseDeserializer $deserializer;

    /**
     * @param Client $client
     * @param ResponseDeserializer $deserializer
     */
    public function __construct(Client $client, ResponseDeserializer $deserializer)
    {
        $this->client = $client;
        $this->deserializer = $deserializer;
    }

    /**
     * Получение списка активных заявок
     *
     * @param string|null $brokerAccountId
     *
     * @return OrdersResponse
     *
     * @throws GuzzleException
     */
    public function get(string $brokerAccountId = null): OrdersResponse
    {
        $query = [];

        if ($brokerAccountId !== null) {
            $query['brokerAccountId'] = $brokerAccountId;
        }

        $response = $this->client->request('GET', '/orders', $query);

        return $this->deserializer->deserialize($response, OrdersResponse::class);
    }

    /**
     * Создание лимитной заявки
     *
     * @param string $figi
     * @param LimitOrderRequest $request
     * @param string|null $brokerAccountId
     *
     * @return LimitOrderResponse
     *
     * @throws GuzzleException
     */
    public function postLimitOrder(string $figi, LimitOrderRequest $request, string $brokerAccountId = null): LimitOrderResponse
    {
        $query = [
            'figi' => $figi,
        ];

        if ($brokerAccountId !== null) {
            $query['brokerAccountId'] = $brokerAccountId;
        }

        $response = $this->client->request(
            'POST',
            '/orders/limit-order',
            $query,
            [
                'lots' => $request->getLots(),
                'operation' => $request->getOperation(),
                'price' => $request->getPrice(),
            ]
        );

        return $this->deserializer->deserialize($response, LimitOrderResponse::class);
    }

    /**
     * Создание рыночной заявки
     *
     * @param string $figi
     * @param MarketOrderRequest $request
     * @param string|null $brokerAccountId
     *
     * @return MarketOrderResponse
     *
     * @throws GuzzleException
     */
    public function postMarketOrder(string $figi, MarketOrderRequest $request, string $brokerAccountId = null): MarketOrderResponse
    {
        $query = [
            'figi' => $figi,
        ];

        if ($brokerAccountId !== null) {
            $query['brokerAccountId'] = $brokerAccountId;
        }

        $response = $this->client->request(
            'POST',
            '/orders/market-order',
            $query,
            [
                'lots' => $request->getLots(),
                'operation' => $request->getOperation(),
            ]
        );

        return $this->deserializer->deserialize($response, MarketOrderResponse::class);
    }

    /**
     * Отмена заявки
     *
     * @param string $orderId
     * @param string|null $brokerAccountId
     *
     * @return EmptyResponse
     *
     * @throws GuzzleException
     */
    public function postCancel(string $orderId, string $brokerAccountId = null): EmptyResponse
    {
        $query = [
            'orderId' => $orderId,
        ];

        if ($brokerAccountId !== null) {
            $query['brokerAccountId'] = $brokerAccountId;
        }

        $response = $this->client->request('POST', '/orders/cancel', $query);

        return $this->deserializer->deserialize($response, EmptyResponse::class);
    }
}
