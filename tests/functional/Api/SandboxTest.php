<?php

namespace Dzhdmitry\TinkoffInvestApi\Tests\functional\Api;

use Dzhdmitry\TinkoffInvestApi\Schema\EmptyResponse;
use Dzhdmitry\TinkoffInvestApi\Tests\ClientHelper;
use Dzhdmitry\TinkoffInvestApi\TinkoffInvest;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class SandboxTest extends TestCase
{
    /**
     * @dataProvider sandboxPostRegisterProvider
     *
     * @param string $brokerAccountType
     * @param string $brokerAccountId
     *
     * @throws GuzzleException
     */
    public function testPostRegister(string $brokerAccountType, string $brokerAccountId)
    {
        $sandbox = TinkoffInvest::create('test-token')
            ->setClient(ClientHelper::createClient('test-token', [
                'brokerAccountType' => $brokerAccountType,
                'brokerAccountId' => $brokerAccountId,
            ]))
            ->sandbox();

        $response = $sandbox->postRegister();

        $this->assertEquals($brokerAccountType, $response->getPayload()->getBrokerAccountType());
        $this->assertEquals($brokerAccountId, $response->getPayload()->getBrokerAccountId());
    }

    /**
     * @dataProvider sandboxPostCurrenciesBalanceProvider
     *
     * @param string $currency
     * @param float $balance
     *
     * @throws GuzzleException
     */
    public function testPostCurrenciesBalance(string $currency, float $balance)
    {
        $sandbox = TinkoffInvest::create('test-token')
            ->setClient(ClientHelper::createClient('test-token', []))
            ->sandbox();

        $response = $sandbox->postCurrenciesBalance($currency, $balance);
        $this->assertInstanceOf(EmptyResponse::class, $response);
    }

//    public function testPostPositionsBalance()
//    {
//        // todo
//    }
//
//    public function testPostRemove()
//    {
//        // todo
//    }
//
//    public function testPostClear()
//    {
//        // todo
//    }

    /**
     * @return array
     */
    public function sandboxPostRegisterProvider(): array
    {
        return [
            ['Tinkoff', 'u78y38'],
            ['TinkoffIis', 'jfh782'],
        ];
    }

    /**
     * @return array
     */
    public function sandboxPostCurrenciesBalanceProvider(): array
    {
        return [
            ['RUB', 100.0],
            ['USD', 50.0],
        ];
    }
}
