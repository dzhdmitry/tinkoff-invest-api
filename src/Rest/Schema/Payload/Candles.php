<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest\Schema\Payload;

class Candles
{
    /**
     * @var string
     */
    private string $figi;

    /**
     * @var string
     */
    private string $interval;

    /**
     * @var Candle[]
     */
    private array $candles;

    /**
     * @param string $figi
     * @param string $interval
     * @param Candle[] $candles
     */
    public function __construct(string $figi, string $interval, array $candles)
    {
        $this->figi = $figi;
        $this->interval = $interval;
        $this->candles = $candles;
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
    public function getInterval(): string
    {
        return $this->interval;
    }

    /**
     * @return Candle[]
     */
    public function getCandles(): array
    {
        return $this->candles;
    }
}
