<?php

namespace Dzhdmitry\TinkoffInvestApi\Tests\functional\Api;

use Dzhdmitry\TinkoffInvestApi\Schema\MarketInstrumentListResponse;
use Dzhdmitry\TinkoffInvestApi\Schema\Payload\MarketInstrumentList;
use Dzhdmitry\TinkoffInvestApi\Tests\ClientHelper;
use Dzhdmitry\TinkoffInvestApi\TinkoffInvest;
use PHPUnit\Framework\TestCase;

class MarketTest extends TestCase
{
    public function testStocks()
    {
        $market = TinkoffInvest::create('test-token')
            ->setClient(ClientHelper::createClient('test-token', [
                'total' => 2,
                'instruments' => [
                    [
                        'figi' => 'BBG000BT9DW0',
                        'ticker' => 'SO',
                        'isin' => 'US8425871071',
                        'minPriceIncrement' => 0.01,
                        'lot' => 1,
                        'currency' => 'USD',
                        'name' => 'Southern',
                        'type' => 'Stock',
                    ],
                    [
                        'figi' => 'BBG000BS9489',
                        'ticker' => 'OMC',
                        'isin' => 'US6819191064',
                        'minPriceIncrement' => 0.01,
                        'lot' => 1,
                        'currency' => 'USD',
                        'name' => 'Omnicom Group',
                        'type' => 'Stock',
                    ],
                ],
            ]))
            ->market();
        $stocks = $market->getStocks();

        $this->assertInstanceOf(MarketInstrumentListResponse::class, $stocks);
        $this->assertInstanceOf(MarketInstrumentList::class, $stocks->getPayload());
        $this->assertEquals(2, $stocks->getPayload()->getTotal());
        $this->assertCount(2, $stocks->getPayload()->getInstruments());

        $instrument1 = $stocks->getPayload()->getInstruments()[0];

        $this->assertEquals('BBG000BT9DW0', $instrument1->getFigi());
        $this->assertEquals('SO', $instrument1->getTicker());
        $this->assertEquals('US8425871071', $instrument1->getIsin());
        $this->assertEquals('Southern', $instrument1->getName());

        $instrument2 = $stocks->getPayload()->getInstruments()[1];

        $this->assertEquals('BBG000BS9489', $instrument2->getFigi());
        $this->assertEquals('OMC', $instrument2->getTicker());
        $this->assertEquals('US6819191064', $instrument2->getIsin());
        $this->assertEquals('Omnicom Group', $instrument2->getName());
    }
}
