<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest\Schema\Response;

use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Payload\Operations;

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
