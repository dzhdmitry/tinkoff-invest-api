<?php

namespace Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Payload;

class Bid
{
    /**
     * @var float
     */
    private float $price;

    /**
     * @var int
     */
    private int $quantity;

    /**
     * @param float $price
     * @param int $quantity
     */
    public function __construct(float $price, int $quantity)
    {
        $this->price = $price;
        $this->quantity = $quantity;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
