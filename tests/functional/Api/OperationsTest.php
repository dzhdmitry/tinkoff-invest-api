<?php

namespace Dzhdmitry\TinkoffInvestApi\Tests\functional\Api;

use Dzhdmitry\TinkoffInvestApi\Schema\OperationsResponse;
use Dzhdmitry\TinkoffInvestApi\Schema\Payload\Operations;
use Dzhdmitry\TinkoffInvestApi\Tests\ClientHelper;
use Dzhdmitry\TinkoffInvestApi\TinkoffInvest;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class OperationsTest extends TestCase
{
    /**
     * @dataProvider operationsGetProvider
     *
     * @param string|null $brokerAccountId
     * @param array $clientResponse
     *
     * @throws GuzzleException
     */
    public function testGet(?string $brokerAccountId, array $clientResponse)
    {
        $market = TinkoffInvest::create('test-token')
            ->setClient(ClientHelper::createClient('test-token', [
                'operations' => $clientResponse,
            ]))
            ->operations($brokerAccountId);
        $operations = $market->get(new \DateTimeImmutable('-1 day'), new \DateTimeImmutable('now'));

        $this->assertInstanceOf(OperationsResponse::class, $operations);
        $this->assertInstanceOf(Operations::class, $operations->getPayload());
        $this->assertCount(1, $operations->getPayload()->getOperations());

        $operation1 = $operations->getPayload()->getOperations()[0];

        $this->assertEquals('2021-01-04 18:38:33', $operation1->getDate()->format('Y-m-d H:i:s'));
        $this->assertEquals('Buy', $operation1->getOperationType());
        $this->assertEquals('Done', $operation1->getStatus());
        $this->assertEquals('BBG0013HGFT4', $operation1->getFigi());
        $this->assertEquals('Currency', $operation1->getInstrumentType());
        $this->assertEquals(74.12, $operation1->getPrice());
        $this->assertEquals(5, $operation1->getQuantity());
        $this->assertEquals(5, $operation1->getQuantityExecuted());
        $this->assertEquals(-370.6, $operation1->getPayment());
        $this->assertEquals('RUB', $operation1->getCurrency());
        $this->assertFalse($operation1->isMarginCall());
        $this->assertEquals(-1.35, $operation1->getCommission()->getValue());
        $this->assertEquals('RUB', $operation1->getCommission()->getCurrency());
        $this->assertEquals('-1.35 RUB', (string) $operation1->getCommission());

        $this->assertCount(1, $operation1->getTrades());

        $this->assertEquals(74.12, $operation1->getTrades()[0]->getPrice());
        $this->assertEquals(5, $operation1->getTrades()[0]->getQuantity());
        $this->assertEquals('2021-01-04 18:38:33', $operation1->getTrades()[0]->getDate()->format('Y-m-d H:i:s'));
        $this->assertEquals('219349878', $operation1->getTrades()[0]->getTradeId());
    }

    /**
     * @dataProvider operationsGetProvider
     *
     * @param string|null $brokerAccountId
     * @param array $clientResponse
     *
     * @throws GuzzleException
     */
    public function testGetFigi(?string $brokerAccountId, array $clientResponse)
    {
        $market = TinkoffInvest::create('test-token')
            ->setClient(ClientHelper::createClient('test-token', [
                'operations' => $clientResponse,
            ]))
            ->operations($brokerAccountId);
        $operations = $market->get(new \DateTimeImmutable('-1 day'), new \DateTimeImmutable('now'), 'BBG0013HGFT4');

        $this->assertInstanceOf(OperationsResponse::class, $operations);
        $this->assertInstanceOf(Operations::class, $operations->getPayload());
        $this->assertCount(1, $operations->getPayload()->getOperations());

        $operation1 = $operations->getPayload()->getOperations()[0];

        $this->assertEquals('2021-01-04 18:38:33', $operation1->getDate()->format('Y-m-d H:i:s'));
        $this->assertEquals('Buy', $operation1->getOperationType());
        $this->assertEquals('Done', $operation1->getStatus());
        $this->assertEquals('BBG0013HGFT4', $operation1->getFigi());
        $this->assertEquals('Currency', $operation1->getInstrumentType());
        $this->assertEquals(74.12, $operation1->getPrice());
        $this->assertEquals(5, $operation1->getQuantity());
        $this->assertEquals(-370.6, $operation1->getPayment());
        $this->assertEquals('RUB', $operation1->getCurrency());
    }

    /**
     * @return array
     */
    public function operationsGetProvider(): array
    {
        $operations = [
            [
                'id' => 'efnw2974',
                'date' => '2021-01-04T18:38:33.131642+03:00',
                'operationType' => 'Buy',
                'status' => 'Done',
                'figi' => 'BBG0013HGFT4',
                'instrumentType' => 'Currency',
                'price' => 74.12,
                'quantity' => 5,
                'quantityExecuted' => 5,
                'payment' => -370.6,
                'commission' => [
                    'value' => -1.35,
                    'currency' => 'RUB',
                ],
                'currency' => 'RUB',
                'isMarginCall' => false,
                'trades' => [
                    [
                        'tradeId' => '219349878',
                        'date' => '2021-01-04T18:38:33.131642+03:00',
                        'price' => 74.12,
                        'quantity' => 5,
                    ],
                ],
            ],
        ];

        return [
            ['account-id', $operations],
            //[null, $operations],
        ];
    }
}
