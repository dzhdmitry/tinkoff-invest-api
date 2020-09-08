<?php

namespace Dzhdmitry\TinkoffInvestApi\Schema\Payload;

class MarketInstrument
{
    /**
     * @var string
     */
    private string $figi;

    /**
     * @var string
     */
    private string $ticker;

    /**
     * @var string|null
     */
    private ?string $isin = null;

    /**
     * @var float|null
     */
    private ?float $minPriceIncrement = null;

    /**
     * @var int
     */
    private int $lot;

    /**
     * @var int|null
     */
    private ?int $minQuantity = null;

    /**
     * @var string
     */
    private string $currency;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $type;

    /**
     * @param string $figi
     * @param string $ticker
     * @param int $lot
     * @param string $currency
     * @param string $name
     * @param string $type
     */
    public function __construct(string $figi, string $ticker, int $lot, string $currency, string $name, string $type)
    {
        $this->figi = $figi;
        $this->ticker = $ticker;
        $this->lot = $lot;
        $this->currency = $currency;
        $this->name = $name;
        $this->type = $type;
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
    public function getTicker(): string
    {
        return $this->ticker;
    }

    /**
     * @return string|null
     */
    public function getIsin(): ?string
    {
        return $this->isin;
    }

    /**
     * @param string|null $isin
     *
     * @return MarketInstrument
     */
    public function setIsin(?string $isin): MarketInstrument
    {
        $this->isin = $isin;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getMinPriceIncrement(): ?float
    {
        return $this->minPriceIncrement;
    }

    /**
     * @param float|null $minPriceIncrement
     *
     * @return MarketInstrument
     */
    public function setMinPriceIncrement(?float $minPriceIncrement): MarketInstrument
    {
        $this->minPriceIncrement = $minPriceIncrement;

        return $this;
    }

    /**
     * @return int
     */
    public function getLot(): int
    {
        return $this->lot;
    }

    /**
     * @return int|null
     */
    public function getMinQuantity(): ?int
    {
        return $this->minQuantity;
    }

    /**
     * @param int|null $minQuantity
     *
     * @return MarketInstrument
     */
    public function setMinQuantity(?int $minQuantity): MarketInstrument
    {
        $this->minQuantity = $minQuantity;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
