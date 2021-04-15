<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest\Schema\Payload;

class Order
{
    /**
     * @var string
     */
    private string $orderId;

    /**
     * @var string
     */
    private string $figi;

    /**
     * @var string
     */
    private string $operation;

    /**
     * @var string
     */
    private string $status;

    /**
     * @var int
     */
    private int $requestedLots;

    /**
     * @var int
     */
    private int $executedLots;

    /**
     * @var string
     */
    private string $type;

    /**
     * @var float
     */
    private float $price;

    /**
     * @param string $orderId
     * @param string $figi
     * @param string $operation
     * @param string $status
     * @param int $requestedLots
     * @param int $executedLots
     * @param string $type
     * @param float $price
     */
    public function __construct(string $orderId, string $figi, string $operation, string $status, int $requestedLots, int $executedLots, string $type, float $price)
    {
        $this->orderId = $orderId;
        $this->figi = $figi;
        $this->operation = $operation;
        $this->status = $status;
        $this->requestedLots = $requestedLots;
        $this->executedLots = $executedLots;
        $this->type = $type;
        $this->price = $price;
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
    public function getFigi(): string
    {
        return $this->figi;
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
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }
}
