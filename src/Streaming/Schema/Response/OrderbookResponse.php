<?php

namespace Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Response;

use Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Payload\Orderbook;

class OrderbookResponse extends AbstractResponse
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
