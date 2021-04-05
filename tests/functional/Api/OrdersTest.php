<?php

namespace Dzhdmitry\TinkoffInvestApi\Tests\functional\Api;

use Dzhdmitry\TinkoffInvestApi\Schema\OrdersResponse;
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
