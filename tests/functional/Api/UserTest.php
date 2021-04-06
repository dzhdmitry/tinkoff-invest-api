<?php

namespace Dzhdmitry\TinkoffInvestApi\Tests\functional\Api;

use Dzhdmitry\TinkoffInvestApi\Schema\Enum\BrokerAccountType;
use Dzhdmitry\TinkoffInvestApi\Schema\Payload\UserAccounts;
use Dzhdmitry\TinkoffInvestApi\Schema\Response\UserAccountsResponse;
use Dzhdmitry\TinkoffInvestApi\Tests\ClientHelper;
use Dzhdmitry\TinkoffInvestApi\TinkoffInvest;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testGetAccounts()
    {
        $user = TinkoffInvest::create('test-token')
            ->setClient(ClientHelper::createClient('test-token', [
                'accounts' => [
                    [
                        'brokerAccountType' => 'Tinkoff',
                        'brokerAccountId' => '27r8tg63r',
                    ],
                    [
                        'brokerAccountType' => 'TinkoffIis',
                        'brokerAccountId' => 'fn3478gf',
                    ],
                ],
            ]))
            ->user();

        $accounts = $user->getAccounts();

        $this->assertInstanceOf(UserAccountsResponse::class, $accounts);
        $this->assertInstanceOf(UserAccounts::class, $accounts->getPayload());
        $this->assertCount(2, $accounts->getPayload()->getAccounts());

        $account1 = $accounts->getPayload()->getAccounts()[0];

        $this->assertEquals(BrokerAccountType::TINKOFF, $account1->getBrokerAccountType());
        $this->assertEquals('27r8tg63r', $account1->getBrokerAccountId());

        $account2 = $accounts->getPayload()->getAccounts()[1];

        $this->assertEquals(BrokerAccountType::TINKOFF_IIS, $account2->getBrokerAccountType());
        $this->assertEquals('fn3478gf', $account2->getBrokerAccountId());
    }
}
