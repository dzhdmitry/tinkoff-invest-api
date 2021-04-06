<?php

namespace Dzhdmitry\TinkoffInvestApi\Schema\Response;

use Dzhdmitry\TinkoffInvestApi\Schema\Payload\Order;

class OrdersResponse extends EmptyResponse
{
    /**
     * @var Order[]
     */
    private array $payload;

    /**
     * @return Order[]
     */
    public function getPayload(): array
    {
        return $this->payload;
    }

    /**
     * @param Order[] $payload
     *
     * @return OrdersResponse
     */
    public function setPayload(array $payload): OrdersResponse
    {
        $this->payload = $payload;

        return $this;
    }
}
