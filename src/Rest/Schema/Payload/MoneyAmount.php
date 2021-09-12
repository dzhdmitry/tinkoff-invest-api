<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest\Schema\Payload;

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
     * @param $value
     */
    public function __construct(string $currency, $value)
    {
        $this->currency = $currency;
        $this->value = (float) $value;
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
        return sprintf('%.2f %s', $this->value, $this->currency);
    }
}
