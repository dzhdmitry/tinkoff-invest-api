<?php

namespace Dzhdmitry\TinkoffInvestApi\Schema\Payload;

class Account
{
    /**
     * @var string
     */
    private string $brokerAccountType;

    /**
     * @var string
     */
    private string $brokerAccountId;

    /**
     * @param string $brokerAccountType
     * @param string $brokerAccountId
     */
    public function __construct(string $brokerAccountType, string $brokerAccountId)
    {
        $this->brokerAccountType = $brokerAccountType;
        $this->brokerAccountId = $brokerAccountId;
    }

    /**
     * @return string
     */
    public function getBrokerAccountType(): string
    {
        return $this->brokerAccountType;
    }

    /**
     * @return string
     */
    public function getBrokerAccountId(): string
    {
        return $this->brokerAccountId;
    }
}
