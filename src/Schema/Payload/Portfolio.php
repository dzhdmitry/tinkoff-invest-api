<?php

namespace Dzhdmitry\TinkoffInvestApi\Schema\Payload;

class Portfolio
{
    /**
     * @var PortfolioPosition[]
     */
    private array $positions;

    /**
     * @param PortfolioPosition[] $positions
     */
    public function __construct(array $positions)
    {
        $this->positions = $positions;
    }

    /**
     * @return PortfolioPosition[]
     */
    public function getPositions(): array
    {
        return $this->positions;
    }
}
