<?php

namespace Dzhdmitry\TinkoffInvestApi\Tests\functional\Api;

use Dzhdmitry\TinkoffInvestApi\RestClientFactory;
use Dzhdmitry\TinkoffInvestApi\Schema\Response\EmptyResponse;
use Dzhdmitry\TinkoffInvestApi\Tests\ClientHelper;
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
        $sandbox = (new RestClientFactory())->create('test-token')
            ->setHttpClient(ClientHelper::createClient([
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
        $sandbox = (new RestClientFactory())->create('test-token')
            ->setHttpClient(ClientHelper::createClient([]))
            ->sandbox();

        $response = $sandbox->postCurrenciesBalance($currency, $balance);
        $this->assertInstanceOf(EmptyResponse::class, $response);
    }

    /**
     * @dataProvider sandboxPostPositionsBalanceProvider
     *
     * @param string $figi
     * @param float $balance
     *
     * @throws GuzzleException
     */
    public function testPostPositionsBalance(string $figi, float $balance)
    {
        $sandbox = (new RestClientFactory())->create('test-token')
            ->setHttpClient(ClientHelper::createClient([]))
            ->sandbox();

        $response = $sandbox->postPositionsBalance($figi, $balance);
        $this->assertInstanceOf(EmptyResponse::class, $response);
    }

    /**
     * @throws GuzzleException
     */
    public function testPostRemove()
    {
        $sandbox = (new RestClientFactory())->create('test-token')
            ->setHttpClient(ClientHelper::createClient([]))
            ->sandbox();

        $response = $sandbox->postRemove();
        $this->assertInstanceOf(EmptyResponse::class, $response);
    }

    /**
     * @throws GuzzleException
     */
    public function testPostClear()
    {
        $sandbox = (new RestClientFactory())->create('test-token')
            ->setHttpClient(ClientHelper::createClient([]))
            ->sandbox();

        $response = $sandbox->postClear();
        $this->assertInstanceOf(EmptyResponse::class, $response);
    }

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

    /**
     * @return array
     */
    public function sandboxPostPositionsBalanceProvider(): array
    {
        return [
            ['BBG000B9XRY4', 5.0],
            ['BBG000BPH459', 6.0],
        ];
    }
}
