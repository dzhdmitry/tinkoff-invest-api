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
     * @var float|null
     */
    private ?float $blocked;

    /**
     * @param string $currency
     * @param float $balance
     * @param float|null $blocked
     */
    public function __construct(string $currency, $balance, ?float $blocked = null)
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
     * @return float|null
     */
    public function getBlocked(): ?float
    {
        return $this->blocked;
    }
}
