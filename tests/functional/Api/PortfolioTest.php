<?php

namespace Dzhdmitry\TinkoffInvestApi\Tests\functional\Api;

use Dzhdmitry\TinkoffInvestApi\Schema\Payload\Portfolio;
use Dzhdmitry\TinkoffInvestApi\Schema\PortfolioResponse;
use Dzhdmitry\TinkoffInvestApi\Tests\ClientHelper;
use Dzhdmitry\TinkoffInvestApi\TinkoffInvest;
use PHPUnit\Framework\TestCase;

class PortfolioTest extends TestCase
{
    public function testGet()
    {
        $portfolio = TinkoffInvest::create('test-token')
            ->setClient(ClientHelper::createClient('test-token', [
                'positions' => [
                    [
                        'figi' => 'BBG000DHPN63',
                        'instrumentType' => 'Stock',
                        'balance' => 3.0,
                        'lots' => 5,
                        'name' => 'Realty Income',
                        'ticker' => 'O',
                        'isin' => 'US7561091049',
                        'expectedYield' => [
                            'currency' => 'USD',
                            'value' => 33.59,
                        ],
                        'averagePositionPrice' => [
                            'currency' => 'USD',
                            'value' => 53.07,
                        ],
                    ],
                    [
                        'figi' => 'BBG00RRT3TX4',
                        'instrumentType' => 'Bond',
                        'balance' => 1.0,
                        'lots' => 1,
                        'name' => 'ОФЗ 25084',
                        'ticker' => 'SU25084RMFS3',
                        'expectedYield' => [
                            'currency' => 'RUB',
                            'value' => 44.99,
                        ],
                        'averagePositionPrice' => [
                            'currency' => 'RUB',
                            'value' => 996.96,
                        ],
                        'averagePositionPriceNoNkd' => [
                            'currency' => 'RUB',
                            'value' => 967.49,
                        ],
                    ],
                    [
                        'figi' => 'BBG0013HGFT4',
                        'instrumentType' => 'Currency',
                        'balance' => 26.89,
                        'lots' => 0,
                        'name' => 'Доллар США',
                        'ticker' => 'USD000UTSTOM',
                        'expectedYield' => [
                            'currency' => 'RUB',
                            'value' => 3.36,
                        ],
                        'averagePositionPrice' => [
                            'currency' => 'RUB',
                            'value' => 76.135,
                        ],
                    ],
                ],
            ]))
            ->portfolio('account-id');

        $response = $portfolio->get();

        $this->assertInstanceOf(PortfolioResponse::class, $response);
        $this->assertInstanceOf(Portfolio::class, $response->getPayload());
        $this->assertCount(3, $response->getPayload()->getPositions());

        $position1 = $response->getPayload()->getPositions()[0];

        $this->assertEquals('BBG000DHPN63', $position1->getFigi());
        $this->assertEquals('Stock', $position1->getInstrumentType());
        $this->assertEquals(3.0, $position1->getBalance());
        $this->assertEquals(5, $position1->getLots());
        $this->assertEquals('Realty Income', $position1->getName());
        $this->assertEquals('O', $position1->getTicker());
        $this->assertEquals('US7561091049', $position1->getIsin());

        $position2 = $response->getPayload()->getPositions()[1];

        $this->assertEquals('BBG00RRT3TX4', $position2->getFigi());
        $this->assertEquals('Bond', $position2->getInstrumentType());
        $this->assertEquals(1.0, $position2->getBalance());
        $this->assertEquals(1, $position2->getLots());
        $this->assertEquals('ОФЗ 25084', $position2->getName());
        $this->assertEquals('SU25084RMFS3', $position2->getTicker());

        $position3 = $response->getPayload()->getPositions()[2];

        $this->assertEquals('BBG0013HGFT4', $position3->getFigi());
        $this->assertEquals('Currency', $position3->getInstrumentType());
        $this->assertEquals(26.89, $position3->getBalance());
        $this->assertEquals(0, $position3->getLots());
        $this->assertEquals('Доллар США', $position3->getName());
        $this->assertEquals('USD000UTSTOM', $position3->getTicker());
    }
}
