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
     * @var float|null
     */
    private ?float $accruedInterest;

    /**
     * @var float|null
     */
    private ?float $limitUp;

    /**
     * @var float|null
     */
    private ?float $limitDown;

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

    /**
     * @return float|null
     */
    public function getAccruedInterest(): ?float
    {
        return $this->accruedInterest;
    }

    /**
     * @param float|null $accruedInterest
     *
     * @return InstrumentInfo
     */
    public function setAccruedInterest(?float $accruedInterest): InstrumentInfo
    {
        $this->accruedInterest = $accruedInterest;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getLimitUp(): ?float
    {
        return $this->limitUp;
    }

    /**
     * @param float|null $limitUp
     *
     * @return InstrumentInfo
     */
    public function setLimitUp(?float $limitUp): InstrumentInfo
    {
        $this->limitUp = $limitUp;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getLimitDown(): ?float
    {
        return $this->limitDown;
    }

    /**
     * @param float|null $limitDown
     *
     * @return InstrumentInfo
     */
    public function setLimitDown(?float $limitDown): InstrumentInfo
    {
        $this->limitDown = $limitDown;

        return $this;
    }
}
