<?php

namespace Dzhdmitry\TinkoffInvestApi\Schema\Payload;

class CurrencyPosition
{
    /**
     * @var string
     */
    private string $currency;

    /**
     * @var float
     */
    private float $balance;

    /**
     * @var int|null
     */
    private ?int $blocked;

    /**
     * @param string $currency
     * @param float $balance
     * @param int|null $blocked
     */
    public function __construct(string $currency, $balance, ?int $blocked = null)
    {
        $this->currency = $currency;
        $this->balance = $balance;
        $this->blocked = $blocked;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @return int|null
     */
    public function getBlocked(): ?int
    {
        return $this->blocked;
    }
}
