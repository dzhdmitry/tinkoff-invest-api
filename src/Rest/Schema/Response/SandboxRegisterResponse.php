<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest\Schema\Response;

use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Payload\Account;

class SandboxRegisterResponse extends EmptyResponse
{
    /**
     * @var Account
     */
    private Account $payload;

    /**
     * @return Account
     */
    public function getPayload(): Account
    {
        return $this->payload;
    }

    /**
     * @param Account $payload
     *
     * @return SandboxRegisterResponse
     */
    public function setPayload(Account $payload): SandboxRegisterResponse
    {
        $this->payload = $payload;

        return $this;
    }
}
