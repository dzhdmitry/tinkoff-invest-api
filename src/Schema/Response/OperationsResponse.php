<?php

namespace Dzhdmitry\TinkoffInvestApi\Schema\Response;

use Dzhdmitry\TinkoffInvestApi\Schema\Payload\Operations;

class OperationsResponse extends EmptyResponse
{
    /**
     * @var Operations
     */
    private Operations $payload;

    /**
     * @return Operations
     */
    public function getPayload(): Operations
    {
        return $this->payload;
    }

    /**
     * @param Operations $payload
     *
     * @return OperationsResponse
     */
    public function setPayload(Operations $payload): OperationsResponse
    {
        $this->payload = $payload;

        return $this;
    }
}
