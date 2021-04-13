<?php

namespace Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Request;

class InstrumentInfoRequest implements RequestInterface
{
    /**
     * @var string
     */
    private string $figi;

    /**
     * @param string $figi
     */
    public function __construct(string $figi)
    {
        $this->figi = $figi;
    }

    /**
     * @inheritDoc
     */
    public function subscribe(): array
    {
        return [
            'event' => 'instrument_info:subscribe',
            'figi' => $this->figi,
        ];
    }

    /**
     * @inheritDoc
     */
    public function unsubscribe(): array
    {
        return [
            'event' => 'instrument_info:unsubscribe',
            'figi' => $this->figi,
        ];
    }
}
