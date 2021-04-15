<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest\Schema\Payload;

class Operations
{
    /**
     * @var Operation[]
     */
    private array $operations;

    /**
     * @param Operation[] $operations
     */
    public function __construct($operations)
    {
        $this->operations = $operations;
    }

    /**
     * @return Operation[]
     */
    public function getOperations(): array
    {
        return $this->operations;
    }
}
