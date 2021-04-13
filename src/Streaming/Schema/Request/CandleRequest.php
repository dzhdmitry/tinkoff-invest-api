<?php

namespace Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Request;

class CandleRequest implements RequestInterface
{
    /**
     * @var string
     */
    private string $figi;

    /**
     * @var string
     */
    private string $interval;

    /**
     * @param string $figi
     * @param string $interval
     */
    public function __construct(string $figi, string $interval)
    {
        $this->figi = $figi;
        $this->interval = $interval;
    }

    /**
     * @inheritDoc
     */
    public function subscribe(): array
    {
        return [
            'event' => 'candle:subscribe',
            'figi' => $this->figi,
            'interval' => $this->interval,
        ];
    }

    /**
     * @inheritDoc
     */
    public function unsubscribe(): array
    {
        return [
            'event' => 'candle:unsubscribe',
            'figi' => $this->figi,
            'interval' => $this->interval,
        ];
    }
}
