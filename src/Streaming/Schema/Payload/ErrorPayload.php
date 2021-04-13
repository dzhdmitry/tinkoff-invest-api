<?php

namespace Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Payload;

class ErrorPayload
{
    /**
     * @var string
     */
    private string $error;

    /**
     * @var string|null
     */
    private ?string $requestId;

    /**
     * @param string $error
     * @param string $requestId
     */
    public function __construct(string $error, string $requestId = null)
    {
        $this->error = $error;
        $this->requestId = $requestId;
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * @return string|null
     */
    public function getRequestId(): ?string
    {
        return $this->requestId;
    }
}
