<?php

namespace Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Payload;

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
     * @var Bid[]
     */
    private array $bids;

    /**
     * @var Ask[]
     */
    private array $asks;

    /**
     * @param string $figi
     * @param int $depth
     * @param array $bids
     * @param array $asks
     */
    public function __construct(string $figi, int $depth, array $bids, array $asks)
    {
        $this->figi = $figi;
        $this->depth = $depth;
        $this->bids = $bids;
        $this->asks = $asks;
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
     * @return Bid[]
     */
    public function getBids(): array
    {
        return $this->bids;
    }

    /**
     * @return Ask[]
     */
    public function getAsks(): array
    {
        return $this->asks;
    }
}
