<?php

namespace Dzhdmitry\TinkoffInvestApi\Schema\Request;

class MarketOrderRequest
{
    /**
     * @var int
     */
    private int $lots;

    /**
     * @var string
     */
    private string $operation;

    /**
     * @param int $lots
     * @param string $operation
     */
    public function __construct(int $lots, string $operation)
    {
        $this->lots = $lots;
        $this->operation = $operation;
    }

    /**
     * @return int
     */
    public function getLots(): int
    {
        return $this->lots;
    }

    /**
     * @return string
     */
    public function getOperation(): string
    {
        return $this->operation;
    }
}
