<?php

namespace Dzhdmitry\TinkoffInvestApi\Schema\Payload;

class PortfolioPosition
{
    /**
     * @var string
     */
    private string $figi;

    /**
     * @var string
     */
    private string $instrumentType;

    /**
     * @var float
     */
    private float $balance;

    /**
     * @var int
     */
    private int $lots;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string|null
     */
    private ?string $ticker = null;

    /**
     * @var string|null
     */
    private ?string $isin = null;

    /**
     * @var float|null
     */
    private ?float $blocked = null;

    /**
     * @var MoneyAmount|null
     */
    private ?MoneyAmount $expectedYield = null;

    /**
     * @var MoneyAmount|null
     */
    private ?MoneyAmount $averagePositionPrice = null;

    /**
     * @var MoneyAmount|null
     */
    private ?MoneyAmount $averagePositionPriceNoNkd = null;

    /**
     * @param string $figi
     * @param string $instrumentType
     * @param float $balance
     * @param int $lots
     * @param string $name
     */
    public function __construct(string $figi, string $instrumentType, float $balance, int $lots, string $name)
    {
        $this->figi = $figi;
        $this->instrumentType = $instrumentType;
        $this->balance = $balance;
        $this->lots = $lots;
        $this->name = $name;
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
    public function getInstrumentType(): string
    {
        return $this->instrumentType;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @return int
     */
    public function getLots(): int
    {
        return $this->lots;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getTicker(): ?string
    {
        return $this->ticker;
    }

    /**
     * @param string|null $ticker
     *
     * @return PortfolioPosition
     */
    public function setTicker(?string $ticker): PortfolioPosition
    {
        $this->ticker = $ticker;

        return $this;
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
     * @return PortfolioPosition
     */
    public function setIsin(?string $isin): PortfolioPosition
    {
        $this->isin = $isin;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getBlocked(): ?float
    {
        return $this->blocked;
    }

    /**
     * @param float|null $blocked
     *
     * @return PortfolioPosition
     */
    public function setBlocked(?float $blocked): PortfolioPosition
    {
        $this->blocked = $blocked;

        return $this;
    }

    /**
     * @return MoneyAmount|null
     */
    public function getExpectedYield(): ?MoneyAmount
    {
        return $this->expectedYield;
    }

    /**
     * @param MoneyAmount|null $expectedYield
     *
     * @return PortfolioPosition
     */
    public function setExpectedYield(?MoneyAmount $expectedYield): PortfolioPosition
    {
        $this->expectedYield = $expectedYield;

        return $this;
    }

    /**
     * @return MoneyAmount|null
     */
    public function getAveragePositionPrice(): ?MoneyAmount
    {
        return $this->averagePositionPrice;
    }

    /**
     * @param MoneyAmount|null $averagePositionPrice
     *
     * @return PortfolioPosition
     */
    public function setAveragePositionPrice(?MoneyAmount $averagePositionPrice): PortfolioPosition
    {
        $this->averagePositionPrice = $averagePositionPrice;

        return $this;
    }

    /**
     * @return MoneyAmount|null
     */
    public function getAveragePositionPriceNoNkd(): ?MoneyAmount
    {
        return $this->averagePositionPriceNoNkd;
    }

    /**
     * @param MoneyAmount|null $averagePositionPriceNoNkd
     *
     * @return PortfolioPosition
     */
    public function setAveragePositionPriceNoNkd(?MoneyAmount $averagePositionPriceNoNkd): PortfolioPosition
    {
        $this->averagePositionPriceNoNkd = $averagePositionPriceNoNkd;

        return $this;
    }
}
