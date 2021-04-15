<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest\Schema\Request;

class LimitOrderRequest
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
     * @var float
     */
    private float $price;

    /**
     * @param int $lots
     * @param string $operation
     * @param float $price
     */
    public function __construct(int $lots, string $operation, float $price)
    {
        $this->lots = $lots;
        $this->operation = $operation;
        $this->price = $price;
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

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }
}
