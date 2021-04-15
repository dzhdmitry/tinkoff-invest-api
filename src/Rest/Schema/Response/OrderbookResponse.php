<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest\Schema\Response;

use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Payload\Orderbook;

class OrderbookResponse extends EmptyResponse
{
    /**
     * @var Orderbook
     */
    private Orderbook $payload;

    /**
     * @return Orderbook
     */
    public function getPayload(): Orderbook
    {
        return $this->payload;
    }

    /**
     * @param Orderbook $payload
     *
     * @return OrderbookResponse
     */
    public function setPayload(Orderbook $payload): OrderbookResponse
    {
        $this->payload = $payload;

        return $this;
    }
}
