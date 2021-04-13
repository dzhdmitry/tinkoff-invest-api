<?php

namespace Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Response;

use Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Payload\Candle;

class CandleResponse extends AbstractResponse
{
    /**
     * @var Candle
     */
    private Candle $payload;

    /**
     * @return Candle
     */
    public function getPayload(): Candle
    {
        return $this->payload;
    }

    /**
     * @param Candle $payload
     *
     * @return CandleResponse
     */
    public function setPayload(Candle $payload): CandleResponse
    {
        $this->payload = $payload;

        return $this;
    }
}
