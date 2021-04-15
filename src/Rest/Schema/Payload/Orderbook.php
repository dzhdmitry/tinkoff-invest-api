<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest\Schema\Payload;

class Orderbook
{
    /**
     * @var string
     */
    private string $figi;

    /**
     * @var int
     */
    private int $depth;

    /**
     * @var OrderResponse[]
     */
    private array $bids;

    /**
     * @var OrderResponse[]
     */
    private array $asks;

    /**
     * @var string
     */
    private string $tradeStatus;

    /**
     * @var float
     */
    private float $minPriceIncrement;

    /**
     * @var float|null
     */
    private ?float $faceValue = null;

    /**
     * @var float|null
     */
    private ?float $lastPrice = null;

    /**
     * @var float|null
     */
    private ?float $closePrice = null;

    /**
     * @var float|null
     */
    private ?float $limitUp = null;

    /**
     * @var float|null
     */
    private ?float $limitDown = null;

    /**
     * @param string $figi
     * @param int $depth
     * @param OrderResponse[] $bids
     * @param OrderResponse[] $asks
     * @param string $tradeStatus
     * @param float $minPriceIncrement
     */
    public function __construct(string $figi, int $depth, array $bids, array $asks, string $tradeStatus, float $minPriceIncrement)
    {
        $this->figi = $figi;
        $this->depth = $depth;
        $this->bids = $bids;
        $this->asks = $asks;
        $this->tradeStatus = $tradeStatus;
        $this->minPriceIncrement = $minPriceIncrement;
    }

    /**
     * @return string
     */
    public function getFigi(): string
    {
        return $this->figi;
    }

    /**
     * @return int
     */
    public function getDepth(): int
    {
        return $this->depth;
    }

    /**
     * @return OrderResponse[]
     */
    public function getBids(): array
    {
        return $this->bids;
    }

    /**
     * @return OrderResponse[]
     */
    public function getAsks(): array
    {
        return $this->asks;
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
     * @return float|null
     */
    public function getFaceValue(): ?float
    {
        return $this->faceValue;
    }

    /**
     * @param float|null $faceValue
     *
     * @return Orderbook
     */
    public function setFaceValue(?float $faceValue): Orderbook
    {
        $this->faceValue = $faceValue;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getLastPrice(): ?float
    {
        return $this->lastPrice;
    }

    /**
     * @param float|null $lastPrice
     *
     * @return Orderbook
     */
    public function setLastPrice(?float $lastPrice): Orderbook
    {
        $this->lastPrice = $lastPrice;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getClosePrice(): ?float
    {
        return $this->closePrice;
    }

    /**
     * @param float|null $closePrice
     *
     * @return Orderbook
     */
    public function setClosePrice(?float $closePrice): Orderbook
    {
        $this->closePrice = $closePrice;

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
     * @return Orderbook
     */
    public function setLimitUp(?float $limitUp): Orderbook
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
     * @return Orderbook
     */
    public function setLimitDown(?float $limitDown): Orderbook
    {
        $this->limitDown = $limitDown;

        return $this;
    }
}
