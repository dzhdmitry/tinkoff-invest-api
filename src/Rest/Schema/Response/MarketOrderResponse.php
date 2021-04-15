<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest\Schema\Response;

use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Payload\PlacedMarketOrder;

class MarketOrderResponse extends EmptyResponse
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
