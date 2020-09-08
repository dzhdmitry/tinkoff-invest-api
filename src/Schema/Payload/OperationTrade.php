<?php

namespace Dzhdmitry\TinkoffInvestApi\Schema\Payload;

class OperationTrade
{
    /**
     * @var string
     */
    private string $tradeId;

    /**
     * @var \DateTimeInterface
     */
    private \DateTimeInterface $date;

    /**
     * @var float
     */
    private float $price;

    /**
     * @var int
     */
    private int $quantity;

    /**
     * @param string $tradeId
     * @param \DateTimeInterface $date
     * @param float $price
     * @param int $quantity
     */
    public function __construct(string $tradeId, \DateTimeInterface $date, float $price, int $quantity)
    {
        $this->tradeId = $tradeId;
        $this->date = $date;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getTradeId(): string
    {
        return $this->tradeId;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDate(): \DateTimeInterface
    {
        return $this->date;
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
