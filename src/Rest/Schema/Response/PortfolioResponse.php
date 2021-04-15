<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest\Schema\Response;

use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Payload\Portfolio;

class PortfolioResponse extends EmptyResponse
{
    /**
     * @var Portfolio
     */
    private Portfolio $payload;

    /**
     * @return Portfolio
     */
    public function getPayload(): Portfolio
    {
        return $this->payload;
    }

    /**
     * @param Portfolio $payload
     *
     * @return PortfolioResponse
     */
    public function setPayload(Portfolio $payload): PortfolioResponse
    {
        $this->payload = $payload;

        return $this;
    }
}
