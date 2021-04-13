<?php

namespace Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Request;

interface RequestInterface
{
    /**
     * @return array
     */
    public function subscribe(): array;

    /**
     * @return array
     */
    public function unsubscribe(): array;
}
