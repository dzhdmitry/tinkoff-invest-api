<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest\Schema\Response;

use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Payload\Currencies;

class CurrenciesResponse extends EmptyResponse
{
    /**
     * @var Currencies
     */
    private Currencies $payload;

    /**
     * @return Currencies
     */
    public function getPayload(): Currencies
    {
        return $this->payload;
    }

    /**
     * @param Currencies $payload
     *
     * @return CurrenciesResponse
     */
    public function setPayload(Currencies $payload): CurrenciesResponse
    {
        $this->payload = $payload;

        return $this;
    }
}
