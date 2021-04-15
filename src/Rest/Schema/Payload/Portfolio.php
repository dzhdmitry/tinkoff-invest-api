<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest\Schema\Payload;

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
