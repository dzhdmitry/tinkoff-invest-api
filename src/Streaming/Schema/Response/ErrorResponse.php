<?php

namespace Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Response;

use Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Payload\ErrorPayload;

class ErrorResponse extends AbstractResponse
{
    /**
     * @var ErrorPayload
     */
    private ErrorPayload $payload;

    /**
     * @return ErrorPayload
     */
    public function getPayload(): ErrorPayload
    {
        return $this->payload;
    }

    /**
     * @param ErrorPayload $payload
     *
     * @return ErrorResponse
     */
    public function setPayload(ErrorPayload $payload): ErrorResponse
    {
        $this->payload = $payload;

        return $this;
    }
}
