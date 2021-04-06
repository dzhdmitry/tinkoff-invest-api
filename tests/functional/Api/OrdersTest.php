<?php

namespace Dzhdmitry\TinkoffInvestApi\Tests\functional\Api;

use Dzhdmitry\TinkoffInvestApi\Schema\EmptyResponse;
use Dzhdmitry\TinkoffInvestApi\Schema\OrdersResponse;
use Dzhdmitry\TinkoffInvestApi\Schema\Request\LimitOrderRequest;
use Dzhdmitry\TinkoffInvestApi\Schema\Request\MarketOrderRequest;
use Dzhdmitry\TinkoffInvestApi\Tests\ClientHelper;
use Dzhdmitry\TinkoffInvestApi\TinkoffInvest;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class OrdersTest extends TestCase
{
    /**
     * @dataProvider ordersGetProvider
     *
     * @param string|null $brokerAccountId
     * @param array $clientResponse
     *
     * @throws GuzzleException
     */
    public function testGet(?string $brokerAccountId, array $clientResponse)
    {
        $orders = TinkoffInvest::create('test-token')
            ->setClient(ClientHelper::createClient('test-token', $clientResponse))
            ->orders($brokerAccountId);

        $response = $orders->get();

        $this->assertInstanceOf(OrdersResponse::class, $response);
        $this->assertCount(1, $response->getPayload());

        $order = $response->getPayload()[0];

        $this->assertEquals('fn2h978rydw', $order->getOrderId());
        $this->assertEquals('BBG000DHPN63', $order->getFigi());
        $this->assertEquals('Buy', $order->getOperation());
        $this->assertEquals('New', $order->getStatus());
        $this->assertEquals(2, $order->getRequestedLots());
        $this->assertEquals(1, $order->getExecutedLots());
        $this->assertEquals('Limit', $order->getType());
        $this->assertEquals(100.2, $order->getPrice());
    }

    public function testPostLimitOrder()
    {
        $orders = TinkoffInvest::create('test-token')
            ->setClient(ClientHelper::createClient('test-token', [
                'orderId' => '5017482',
                'operation' => 'Buy',
                'status' => 'New',
                'requestedLots' => 5,
                'executedLots' => 5,
                'commission' => [
                    'value' => 1.16,
                    'currency' => 'RUB',
                ],
            ]))
            ->orders();

        $response = $orders->postLimitOrder('BBG0013HGFT4', new LimitOrderRequest(5, 'Buy', 75.20));

        $this->assertEquals('5017482', $response->getPayload()->getOrderId());
        $this->assertEquals('Buy', $response->getPayload()->getOperation());
        $this->assertEquals('New', $response->getPayload()->getStatus());
        $this->assertNull($response->getPayload()->getRejectReason());
        $this->assertNull($response->getPayload()->getMessage());
        $this->assertEquals(5, $response->getPayload()->getRequestedLots());
        $this->assertEquals(5, $response->getPayload()->getExecutedLots());
        $this->assertEquals(1.16, $response->getPayload()->getCommission()->getValue());
        $this->assertEquals('RUB', $response->getPayload()->getCommission()->getCurrency());
    }

    public function testPostMarketOrder()
    {
        $orders = TinkoffInvest::create('test-token')
            ->setClient(ClientHelper::createClient('test-token', [
                'orderId' => '5017482',
                'operation' => 'Buy',
                'status' => 'New',
                'requestedLots' => 5,
                'executedLots' => 5,
                'commission' => [
                    'value' => 1.16,
                    'currency' => 'RUB',
                ],
            ]))
            ->orders();

        $response = $orders->postMarketOrder('BBG0013HGFT4', new MarketOrderRequest(5, 'Buy'));

        $this->assertEquals('5017482', $response->getPayload()->getOrderId());
        $this->assertEquals('Buy', $response->getPayload()->getOperation());
        $this->assertEquals('New', $response->getPayload()->getStatus());
        $this->assertNull($response->getPayload()->getRejectReason());
        $this->assertNull($response->getPayload()->getMessage());
        $this->assertEquals(5, $response->getPayload()->getRequestedLots());
        $this->assertEquals(5, $response->getPayload()->getExecutedLots());
        $this->assertEquals(1.16, $response->getPayload()->getCommission()->getValue());
        $this->assertEquals('RUB', $response->getPayload()->getCommission()->getCurrency());
    }

    public function testPostCancel()
    {
        $orders = TinkoffInvest::create('test-token')
            ->setClient(ClientHelper::createClient('test-token', []))
            ->orders('');

        $response = $orders->postCancel('iufwhr247');

        $this->assertInstanceOf(EmptyResponse::class, $response);
    }

    /**
     * @return array
     */
    public function ordersGetProvider(): array
    {
        $orders = [
            [
                'orderId' => 'fn2h978rydw',
                'figi' => 'BBG000DHPN63',
                'operation' => 'Buy',
                'status' => 'New',
                'requestedLots' => 2,
                'executedLots' => 1,
                'type' => 'Limit',
                'price' => 100.2,
            ],
        ];

        return [
            ['account-id', $orders],
            [null, $orders],
        ];
    }
}
