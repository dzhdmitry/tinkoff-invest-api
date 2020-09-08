<?php

namespace Dzhdmitry\TinkoffInvestApi\Schema\Payload;

class MoneyAmount
{
    /**
     * @var string
     */
    private string $currency;

    /**
     * @var float
     */
    private float $value;

    /**
     * @param string $currency
     * @param float $value
     */
    public function __construct(string $currency, $value)
    {
        $this->currency = $currency;
        $this->value = $value;
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
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            is_float($this->value) ? '%.2f %s' : '%d %s',
            $this->value,
            $this->currency
        );
    }
}
