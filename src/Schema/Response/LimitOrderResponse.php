<?php

namespace Dzhdmitry\TinkoffInvestApi\Schema\Response;

use Dzhdmitry\TinkoffInvestApi\Schema\Payload\PlacedLimitOrder;

class LimitOrderResponse extends EmptyResponse
{
    /**
     * @var PlacedLimitOrder
     */
    private PlacedLimitOrder $payload;

    /**
     * @return PlacedLimitOrder
     */
    public function getPayload(): PlacedLimitOrder
    {
        return $this->payload;
    }

    /**
     * @param PlacedLimitOrder $payload
     *
     * @return LimitOrderResponse
     */
    public function setPayload(PlacedLimitOrder $payload): LimitOrderResponse
    {
        $this->payload = $payload;

        return $this;
    }
}
