<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest\Schema\Response;

use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Payload\UserAccounts;

class UserAccountsResponse extends EmptyResponse
{
    /**
     * @var UserAccounts
     */
    private UserAccounts $payload;

    /**
     * @return UserAccounts
     */
    public function getPayload(): UserAccounts
    {
        return $this->payload;
    }

    /**
     * @param UserAccounts $payload
     *
     * @return UserAccountsResponse
     */
    public function setPayload(UserAccounts $payload): UserAccountsResponse
    {
        $this->payload = $payload;

        return $this;
    }
}
