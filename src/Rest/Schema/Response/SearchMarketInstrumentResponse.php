<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest\Schema\Response;

use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Payload\SearchMarketInstrument;

class SearchMarketInstrumentResponse extends EmptyResponse
{
    /**
     * @var SearchMarketInstrument
     */
    private SearchMarketInstrument $payload;

    /**
     * @return SearchMarketInstrument
     */
    public function getPayload(): SearchMarketInstrument
    {
        return $this->payload;
    }

    /**
     * @param SearchMarketInstrument $payload
     *
     * @return SearchMarketInstrumentResponse
     */
    public function setPayload(SearchMarketInstrument $payload): SearchMarketInstrumentResponse
    {
        $this->payload = $payload;

        return $this;
    }
}
