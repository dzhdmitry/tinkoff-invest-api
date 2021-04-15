<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest\Schema\Payload;

class UserAccounts
{
    /**
     * @var Account[]
     */
    private array $accounts;

    /**
     * @param Account[] $accounts
     */
    public function __construct(array $accounts)
    {
        $this->accounts = $accounts;
    }

    /**
     * @return Account[]
     */
    public function getAccounts(): array
    {
        return $this->accounts;
    }
}
