<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest\Schema\Payload;

class Currencies
{
    /**
     * @var CurrencyPosition[]
     */
    private array $currencies;

    /**
     * @param CurrencyPosition[] $currencies
     */
    public function __construct(array $currencies)
    {
        $this->currencies = $currencies;
    }

    /**
     * @return CurrencyPosition[]
     */
    public function getCurrencies(): array
    {
        return $this->currencies;
    }
}
