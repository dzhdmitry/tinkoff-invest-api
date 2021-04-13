<?php

namespace Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Request;

class OrderbookRequest implements RequestInterface
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
     * @param string $figi
     * @param int $depth
     */
    public function __construct(string $figi, int $depth)
    {
        $this->figi = $figi;
        $this->depth = $depth;
    }

    /**
     * @inheritDoc
     */
    public function subscribe(): array
    {
        return [
            'event' => 'orderbook:subscribe',
            'figi' => $this->figi,
            'depth' => $this->depth,
        ];
    }

    /**
     * @inheritDoc
     */
    public function unsubscribe(): array
    {
        return [
            'event' => 'orderbook:unsubscribe',
            'figi' => $this->figi,
            'depth' => $this->depth,
        ];
    }
}
