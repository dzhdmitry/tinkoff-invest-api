<?php

namespace Dzhdmitry\TinkoffInvestApi\Schema\Response;

use Dzhdmitry\TinkoffInvestApi\Schema\Payload\Portfolio;

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
