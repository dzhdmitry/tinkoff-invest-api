<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest\Schema\Response;

class EmptyResponse
{
    /**
     * @var string
     */
    protected string $trackingId;

    /**
     * @var string
     */
    protected string $status;

    /**
     * @param string $trackingId
     * @param string $status
     */
    public function __construct(string $trackingId, string $status)
    {
        $this->trackingId = $trackingId;
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getTrackingId(): string
    {
        return $this->trackingId;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}
