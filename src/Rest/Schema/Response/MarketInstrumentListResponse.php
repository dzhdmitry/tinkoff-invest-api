<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest\Schema\Response;

use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Payload\MarketInstrumentList;

class MarketInstrumentListResponse extends EmptyResponse
{
    /**
     * @var MarketInstrumentList
     */
    private MarketInstrumentList $payload;

    /**
     * @return MarketInstrumentList
     */
    public function getPayload(): MarketInstrumentList
    {
        return $this->payload;
    }

    /**
     * @param MarketInstrumentList $payload
     *
     * @return MarketInstrumentListResponse
     */
    public function setPayload(MarketInstrumentList $payload): MarketInstrumentListResponse
    {
        $this->payload = $payload;

        return $this;
    }
}
