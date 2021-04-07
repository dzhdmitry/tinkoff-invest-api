<?php

namespace Dzhdmitry\TinkoffInvestApi\Api;

use Dzhdmitry\TinkoffInvestApi\RestClient;
use Dzhdmitry\TinkoffInvestApi\Schema\Response\EmptyResponse;
use Dzhdmitry\TinkoffInvestApi\Schema\Response\LimitOrderResponse;
use Dzhdmitry\TinkoffInvestApi\Schema\Response\MarketOrderResponse;
use Dzhdmitry\TinkoffInvestApi\Schema\Response\OrdersResponse;
use Dzhdmitry\TinkoffInvestApi\Schema\Request\LimitOrderRequest;
use Dzhdmitry\TinkoffInvestApi\Schema\Request\MarketOrderRequest;
use GuzzleHttp\Exception\GuzzleException;

/**
 * https://tinkoffcreditsystems.github.io/invest-openapi/swagger-ui/#/orders
 */
class Orders
{
    /**
     * @var RestClient
     */
    private RestClient $client;

    /**
     * @param RestClient $client
     */
    public function __construct(RestClient $client)
    {
        $this->client = $client;
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

        return $this->client->get('/openapi/orders', OrdersResponse::class, $query);
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

        return $this->client->post(
            '/openapi/orders/limit-order',
            LimitOrderResponse::class,
            $query,
            [
                'lots' => $request->getLots(),
                'operation' => $request->getOperation(),
                'price' => $request->getPrice(),
            ]
        );
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

        return $this->client->post(
            '/openapi/orders/market-order',
            MarketOrderResponse::class,
            $query,
            [
                'lots' => $request->getLots(),
                'operation' => $request->getOperation(),
            ]
        );
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

        return $this->client->post('/openapi/orders/cancel', EmptyResponse::class, $query);
    }
}
