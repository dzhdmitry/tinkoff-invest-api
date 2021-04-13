<?php

namespace Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Response;

use Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Payload\InstrumentInfo;

class InstrumentInfoResponse extends AbstractResponse
{
    /**
     * @var InstrumentInfo
     */
    private InstrumentInfo $payload;

    /**
     * @return InstrumentInfo
     */
    public function getPayload(): InstrumentInfo
    {
        return $this->payload;
    }

    /**
     * @param InstrumentInfo $payload
     *
     * @return InstrumentInfoResponse
     */
    public function setPayload(InstrumentInfo $payload): InstrumentInfoResponse
    {
        $this->payload = $payload;

        return $this;
    }
}
