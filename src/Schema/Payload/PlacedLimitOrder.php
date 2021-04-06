<?php

namespace Dzhdmitry\TinkoffInvestApi\Schema\Payload;

class PlacedLimitOrder
{
    /**
     * @var string
     */
    private string $orderId;

    /**
     * @var string
     */
    private string $operation;

    /**
     * @var string
     */
    private string $status;

    /**
     * @var string|null
     */
    private ?string $rejectReason = null;

    /**
     * @var string|null
     */
    private ?string $message = null;

    /**
     * @var int
     */
    private int $requestedLots;

    /**
     * @var int
     */
    private int $executedLots;

    /**
     * @var MoneyAmount|null
     */
    private ?MoneyAmount $commission = null;

    /**
     * @param string $orderId
     * @param string $operation
     * @param string $status
     * @param int $requestedLots
     * @param int $executedLots
     */
    public function __construct(string $orderId, string $operation, string $status, int $requestedLots, int $executedLots)
    {
        $this->orderId = $orderId;
        $this->operation = $operation;
        $this->status = $status;
        $this->requestedLots = $requestedLots;
        $this->executedLots = $executedLots;
    }

    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }

    /**
     * @return string
     */
    public function getOperation(): string
    {
        return $this->operation;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string|null
     */
    public function getRejectReason(): ?string
    {
        return $this->rejectReason;
    }

    /**
     * @param string|null $rejectReason
     *
     * @return PlacedLimitOrder
     */
    public function setRejectReason(?string $rejectReason): PlacedLimitOrder
    {
        $this->rejectReason = $rejectReason;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     *
     * @return PlacedLimitOrder
     */
    public function setMessage(?string $message): PlacedLimitOrder
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return int
     */
    public function getRequestedLots(): int
    {
        return $this->requestedLots;
    }

    /**
     * @return int
     */
    public function getExecutedLots(): int
    {
        return $this->executedLots;
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
     * @return PlacedLimitOrder
     */
    public function setCommission(?MoneyAmount $commission): PlacedLimitOrder
    {
        $this->commission = $commission;

        return $this;
    }
}
