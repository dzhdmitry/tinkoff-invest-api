<?php

namespace Dzhdmitry\TinkoffInvestApi\Schema;

use Dzhdmitry\TinkoffInvestApi\Schema\Payload\PlacedMarketOrder;

class MarketOrderResponse
{
    /**
     * @var PlacedMarketOrder
     */
    private PlacedMarketOrder $payload;

    /**
     * @return PlacedMarketOrder
     */
    public function getPayload(): PlacedMarketOrder
    {
        return $this->payload;
    }

    /**
     * @param PlacedMarketOrder $payload
     *
     * @return MarketOrderResponse
     */
    public function setPayload(PlacedMarketOrder $payload): MarketOrderResponse
    {
        $this->payload = $payload;

        return $this;
    }
}
