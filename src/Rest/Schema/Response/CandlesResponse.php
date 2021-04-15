<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest\Schema\Response;

use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Payload\Candles;

class CandlesResponse extends EmptyResponse
{
    /**
     * @var Candles
     */
    private Candles $payload;

    /**
     * @return Candles
     */
    public function getPayload(): Candles
    {
        return $this->payload;
    }

    /**
     * @param Candles $payload
     *
     * @return CandlesResponse
     */
    public function setPayload(Candles $payload): CandlesResponse
    {
        $this->payload = $payload;

        return $this;
    }
}
