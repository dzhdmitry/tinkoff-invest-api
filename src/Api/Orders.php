<?php

namespace Dzhdmitry\TinkoffInvestApi\Api;

use Dzhdmitry\TinkoffInvestApi\RestClientFacade;
use Dzhdmitry\TinkoffInvestApi\Schema\EmptyResponse;
use Dzhdmitry\TinkoffInvestApi\Schema\OrdersResponse;
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
        return $this->clientFacade->postAndSerialize('/openapi/orders/cancel', EmptyResponse::class, [], [
            'orderId' => $orderId,
        ]);
    }
}
