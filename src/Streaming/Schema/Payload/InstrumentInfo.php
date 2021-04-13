<?php

namespace Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Payload;

class InstrumentInfo
{
    /**
     * @var string
     */
    private string $figi;

    /**
     * @var string
     */
    private string $tradeStatus;

    /**
     * @var float
     */
    private float $minPriceIncrement;

    /**
     * @var int
     */
    private int $lot;

    /**
     * @param string $figi
     * @param string $tradeStatus
     * @param float $minPriceIncrement
     * @param int $lot
     */
    public function __construct(string $figi, string $tradeStatus, float $minPriceIncrement, int $lot)
    {
        $this->figi = $figi;
        $this->tradeStatus = $tradeStatus;
        $this->minPriceIncrement = $minPriceIncrement;
        $this->lot = $lot;
    }

    /**
     * @return string
     */
    public function getFigi(): string
    {
        return $this->figi;
    }

    /**
     * @return string
     */
    public function getTradeStatus(): string
    {
        return $this->tradeStatus;
    }

    /**
     * @return float
     */
    public function getMinPriceIncrement(): float
    {
        return $this->minPriceIncrement;
    }

    /**
     * @return int
     */
    public function getLot(): int
    {
        return $this->lot;
    }
}
