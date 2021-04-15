<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest\Schema\Payload;

class Operation
{
    /**
     * @var string
     */
    private string $id;

    /**
     * @var string
     */
    private string $status;

    /**
     * @var OperationTrade[]
     */
    private array $trades = [];

    /**
     * @var MoneyAmount|null
     */
    private ?MoneyAmount $commission = null;

    /**
     * @var string
     */
    private string $currency;

    /**
     * @var float
     */
    private float $payment;

    /**
     * @var float|null
     */
    private ?float $price = null;

    /**
     * @var int|null
     */
    private ?int $quantity = null;

    /**
     * @var int|null
     */
    private ?int $quantityExecuted = null;

    /**
     * @var string|null
     */
    private ?string $figi = null;

    /**
     * @var string|null
     */
    private ?string $instrumentType = null;

    /**
     * @var bool
     */
    private bool $isMarginCall;

    /**
     * @var \DateTimeInterface
     */
    private \DateTimeInterface $date;

    /**
     * @var string|null
     */
    private ?string $operationType = null;

    /**
     * @param string $id
     * @param string $status
     * @param string $currency
     * @param float $payment
     * @param bool $isMarginCall
     * @param \DateTimeInterface $date
     */
    public function __construct(string $id, string $status, string $currency, float $payment, bool $isMarginCall, \DateTimeInterface $date)
    {
        $this->id = $id;
        $this->status = $status;
        $this->currency = $currency;
        $this->payment = $payment;
        $this->isMarginCall = $isMarginCall;
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return OperationTrade[]
     */
    public function getTrades(): array
    {
        return $this->trades;
    }

    /**
     * @param OperationTrade[] $trades
     *
     * @return Operation
     */
    public function setTrades(array $trades): Operation
    {
        $this->trades = $trades;

        return $this;
    }

    /**
     * @return MoneyAmount|null
     */
    public function getCommission(): ?MoneyAmount
    {
        return $this->commission;
    }

    /**
     * @param MoneyAmount|null $commission
     *
     * @return Operation
     */
    public function setCommission(?MoneyAmount $commission): Operation
    {
        $this->commission = $commission;

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
     * @return float
     */
    public function getPayment(): float
    {
        return $this->payment;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     *
     * @return Operation
     */
    public function setPrice(?float $price): Operation
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * @param int|null $quantity
     *
     * @return Operation
     */
    public function setQuantity(?int $quantity): Operation
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getQuantityExecuted(): ?int
    {
        return $this->quantityExecuted;
    }

    /**
     * @param int|null $quantityExecuted
     *
     * @return Operation
     */
    public function setQuantityExecuted(?int $quantityExecuted): Operation
    {
        $this->quantityExecuted = $quantityExecuted;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFigi(): ?string
    {
        return $this->figi;
    }

    /**
     * @param string|null $figi
     *
     * @return Operation
     */
    public function setFigi(?string $figi): Operation
    {
        $this->figi = $figi;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getInstrumentType(): ?string
    {
        return $this->instrumentType;
    }

    /**
     * @param string|null $instrumentType
     *
     * @return Operation
     */
    public function setInstrumentType(?string $instrumentType): Operation
    {
        $this->instrumentType = $instrumentType;

        return $this;
    }

    /**
     * @return bool
     */
    public function isMarginCall(): bool
    {
        return $this->isMarginCall;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @return string|null
     */
    public function getOperationType(): ?string
    {
        return $this->operationType;
    }

    /**
     * @param string|null $operationType
     *
     * @return Operation
     */
    public function setOperationType(?string $operationType): Operation
    {
        $this->operationType = $operationType;

        return $this;
    }
}
