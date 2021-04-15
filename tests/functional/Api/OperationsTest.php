<?php

namespace Dzhdmitry\TinkoffInvestApi\Tests\functional\Api;

use Dzhdmitry\TinkoffInvestApi\Rest\ClientFactory;
use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Enum\Currency;
use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Enum\InstrumentType;
use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Enum\OperationTypeWithCommission;
use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Response\OperationsResponse;
use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Payload\Operations;
use Dzhdmitry\TinkoffInvestApi\Tests\ClientHelper;
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
        $market = (new ClientFactory())->create('test-token')
            ->setHttpClient(ClientHelper::createClient([
                'operations' => $clientResponse,
            ]))
            ->operations();
        $operations = $market->get(new \DateTimeImmutable('-1 day'), new \DateTimeImmutable('now'), null, $brokerAccountId);

        $this->assertInstanceOf(OperationsResponse::class, $operations);
        $this->assertInstanceOf(Operations::class, $operations->getPayload());
        $this->assertCount(1, $operations->getPayload()->getOperations());

        $operation1 = $operations->getPayload()->getOperations()[0];

        $this->assertEquals('2021-01-04 18:38:33', $operation1->getDate()->format('Y-m-d H:i:s'));
        $this->assertEquals(OperationTypeWithCommission::BUY, $operation1->getOperationType());
        $this->assertEquals('Done', $operation1->getStatus());
        $this->assertEquals('BBG0013HGFT4', $operation1->getFigi());
        $this->assertEquals(InstrumentType::CURRENCY, $operation1->getInstrumentType());
        $this->assertEquals(74.12, $operation1->getPrice());
        $this->assertEquals(5, $operation1->getQuantity());
        $this->assertEquals(5, $operation1->getQuantityExecuted());
        $this->assertEquals(-370.6, $operation1->getPayment());
        $this->assertEquals(Currency::RUB, $operation1->getCurrency());
        $this->assertFalse($operation1->isMarginCall());
        $this->assertEquals(-1.35, $operation1->getCommission()->getValue());
        $this->assertEquals(Currency::RUB, $operation1->getCommission()->getCurrency());
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
        $market = (new ClientFactory())->create('test-token')
            ->setHttpClient(ClientHelper::createClient([
                'operations' => $clientResponse,
            ]))
            ->operations();
        $operations = $market->get(new \DateTimeImmutable('-1 day'), new \DateTimeImmutable('now'), 'BBG0013HGFT4', $brokerAccountId);

        $this->assertInstanceOf(OperationsResponse::class, $operations);
        $this->assertInstanceOf(Operations::class, $operations->getPayload());
        $this->assertCount(1, $operations->getPayload()->getOperations());

        $operation1 = $operations->getPayload()->getOperations()[0];

        $this->assertEquals('2021-01-04 18:38:33', $operation1->getDate()->format('Y-m-d H:i:s'));
        $this->assertEquals(OperationTypeWithCommission::BUY, $operation1->getOperationType());
        $this->assertEquals('Done', $operation1->getStatus());
        $this->assertEquals('BBG0013HGFT4', $operation1->getFigi());
        $this->assertEquals(InstrumentType::CURRENCY, $operation1->getInstrumentType());
        $this->assertEquals(74.12, $operation1->getPrice());
        $this->assertEquals(5, $operation1->getQuantity());
        $this->assertEquals(-370.6, $operation1->getPayment());
        $this->assertEquals(Currency::RUB, $operation1->getCurrency());
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
            [null, $operations],
        ];
    }
}
