<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest\Schema\Payload;

class SearchMarketInstrument
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
     * @var string|null
     */
    private ?string $currency = null;

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
     * @param string $name
     * @param string $type
     */
    public function __construct(string $figi, string $ticker, int $lot, string $name, string $type)
    {
        $this->figi = $figi;
        $this->ticker = $ticker;
        $this->lot = $lot;
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
     * @return SearchMarketInstrument
     */
    public function setIsin(?string $isin): SearchMarketInstrument
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
     * @return SearchMarketInstrument
     */
    public function setMinPriceIncrement(?float $minPriceIncrement): SearchMarketInstrument
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
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @param string|null $currency
     *
     * @return SearchMarketInstrument
     */
    public function setCurrency(?string $currency): SearchMarketInstrument
    {
        $this->currency = $currency;

        return $this;
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
