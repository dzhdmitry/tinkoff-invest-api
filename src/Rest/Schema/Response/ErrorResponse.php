<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest\Schema\Response;

use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Payload\Error;

class ErrorResponse extends EmptyResponse
{
    /**
     * @var Error
     */
    private Error $payload;

    /**
     * @return Error
     */
    public function getPayload(): Error
    {
        return $this->payload;
    }

    /**
     * @param Error $payload
     *
     * @return ErrorResponse
     */
    public function setPayload(Error $payload): ErrorResponse
    {
        $this->payload = $payload;

        return $this;
    }
}
