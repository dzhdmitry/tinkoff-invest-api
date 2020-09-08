<?php

namespace Dzhdmitry\TinkoffInvestApi\Schema\Payload;

class MarketInstrumentList
{
    /**
     * @var int
     */
    private int $total;

    /**
     * @var MarketInstrument[]
     */
    private array $instruments;

    /**
     * @param int $total
     * @param MarketInstrument[] $instruments
     */
    public function __construct(int $total, $instruments)
    {
        $this->total = $total;
        $this->instruments = $instruments;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @return MarketInstrument[]
     */
    public function getInstruments(): array
    {
        return $this->instruments;
    }
}
