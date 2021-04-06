<?php

namespace Dzhdmitry\TinkoffInvestApi\Api;

use Dzhdmitry\TinkoffInvestApi\RestClientFacade;
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
     * @var RestClientFacade
     */
    private RestClientFacade $clientFacade;

    /**
     * @param RestClientFacade $clientFacade
     */
    public function __construct(RestClientFacade $clientFacade)
    {
        $this->clientFacade = $clientFacade;
    }

    /**
     * Получение списка активных заявок
     *
     * @return OrdersResponse
     *
     * @throws GuzzleException
     */
    public function get(): OrdersResponse
    {
        return $this->clientFacade->getAndSerialize('/openapi/orders', OrdersResponse::class);
    }

    /**
     * Создание лимитной заявки
     *
     * @param string $figi
     * @param LimitOrderRequest $request
     *
     * @return LimitOrderResponse
     *
     * @throws GuzzleException
     */
    public function postLimitOrder(string $figi, LimitOrderRequest $request): LimitOrderResponse
    {
        return $this->clientFacade->postAndSerialize(
            '/openapi/orders/limit-order',
            LimitOrderResponse::class,
            [
                'figi' => $figi,
            ],
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
     *
     * @return MarketOrderResponse
     *
     * @throws GuzzleException
     */
    public function postMarketOrder(string $figi, MarketOrderRequest $request): MarketOrderResponse
    {
        return $this->clientFacade->postAndSerialize(
            '/openapi/orders/market-order',
            MarketOrderResponse::class,
            [
                'figi' => $figi,
            ],
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
     *
     * @return EmptyResponse
     *
     * @throws GuzzleException
     */
    public function postCancel(string $orderId): EmptyResponse
    {
        return $this->clientFacade->postAndSerialize('/openapi/orders/cancel', EmptyResponse::class, [
            'orderId' => $orderId,
        ]);
    }
}
