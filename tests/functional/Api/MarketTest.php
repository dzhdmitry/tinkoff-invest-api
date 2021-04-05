<?php

namespace Dzhdmitry\TinkoffInvestApi\Tests\functional\Api;

use Dzhdmitry\TinkoffInvestApi\Schema\MarketInstrumentListResponse;
use Dzhdmitry\TinkoffInvestApi\Schema\Payload\MarketInstrumentList;
use Dzhdmitry\TinkoffInvestApi\Tests\ClientHelper;
use Dzhdmitry\TinkoffInvestApi\TinkoffInvest;
use PHPUnit\Framework\TestCase;

class MarketTest extends TestCase
{
    public function testGetStocks()
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
        $this->assertEquals('USD', $instrument1->getCurrency());
        $this->assertEquals('Stock', $instrument1->getType());
        $this->assertEquals(0.01, $instrument1->getMinPriceIncrement());

        $instrument2 = $stocks->getPayload()->getInstruments()[1];

        $this->assertEquals('BBG000BS9489', $instrument2->getFigi());
        $this->assertEquals('OMC', $instrument2->getTicker());
        $this->assertEquals('US6819191064', $instrument2->getIsin());
        $this->assertEquals('Omnicom Group', $instrument2->getName());
        $this->assertEquals('USD', $instrument1->getCurrency());
        $this->assertEquals('Stock', $instrument1->getType());
        $this->assertEquals(0.01, $instrument1->getMinPriceIncrement());
    }

    public function testGetBonds()
    {
        $market = TinkoffInvest::create('test-token')
            ->setClient(ClientHelper::createClient('test-token', [
                'total' => 2,
                'instruments' => [
                    [
                        'figi' => 'BBG00T22WKV5',
                        'ticker' => 'SU29013RMFS8',
                        'isin' => 'RU000A101KT1',
                        'minPriceIncrement' => 0.01,
                        'lot' => 1,
                        'currency' => 'RUB',
                        'name' => 'ОФЗ 29013',
                        'type' => 'Bond',
                    ],
                    [
                        'figi' => 'BBG003P5FHW5',
                        'ticker' => 'XS0861981180',
                        'isin' => 'XS0861981180',
                        'minPriceIncrement' => 0.001,
                        'lot' => 1,
                        'currency' => 'USD',
                        'name' => 'Rosneft',
                        'type' => 'Bond',
                    ],
                ],
            ]))
            ->market();
        $bonds = $market->getBonds();

        $this->assertInstanceOf(MarketInstrumentListResponse::class, $bonds);
        $this->assertInstanceOf(MarketInstrumentList::class, $bonds->getPayload());
        $this->assertEquals(2, $bonds->getPayload()->getTotal());
        $this->assertCount(2, $bonds->getPayload()->getInstruments());

        $instrument1 = $bonds->getPayload()->getInstruments()[0];

        $this->assertEquals('BBG00T22WKV5', $instrument1->getFigi());
        $this->assertEquals('SU29013RMFS8', $instrument1->getTicker());
        $this->assertEquals('RU000A101KT1', $instrument1->getIsin());
        $this->assertEquals('ОФЗ 29013', $instrument1->getName());
        $this->assertEquals('RUB', $instrument1->getCurrency());
        $this->assertEquals('Bond', $instrument1->getType());
        $this->assertEquals(0.01, $instrument1->getMinPriceIncrement());

        $instrument2 = $bonds->getPayload()->getInstruments()[1];

        $this->assertEquals('BBG003P5FHW5', $instrument2->getFigi());
        $this->assertEquals('XS0861981180', $instrument2->getTicker());
        $this->assertEquals('XS0861981180', $instrument2->getIsin());
        $this->assertEquals('Rosneft', $instrument2->getName());
        $this->assertEquals('USD', $instrument2->getCurrency());
        $this->assertEquals('Bond', $instrument2->getType());
        $this->assertEquals(0.001, $instrument2->getMinPriceIncrement());
    }

    public function testGetEtfs()
    {
        $market = TinkoffInvest::create('test-token')
            ->setClient(ClientHelper::createClient('test-token', [
                'total' => 2,
                'instruments' => [
                    [
                        'figi' => 'BBG333333333',
                        'ticker' => 'TMOS',
                        'isin' => 'RU000A101X76',
                        'minPriceIncrement' => 0.002,
                        'lot' => 1,
                        'currency' => 'RUB',
                        'name' => 'Тинькофф iMOEX',
                        'type' => 'Etf',
                    ],
                    [
                        'figi' => 'BBG00Q3HQJ74',
                        'ticker' => 'AKEU',
                        'isin' => 'RU000A100Q43',
                        'minPriceIncrement' => 0.01,
                        'lot' => 1,
                        'currency' => 'EUR',
                        'name' => 'Альфа-Капитал Европа 600',
                        'type' => 'Etf',
                    ],
                ],
            ]))
            ->market();
        $etfs = $market->getEtfs();

        $this->assertInstanceOf(MarketInstrumentListResponse::class, $etfs);
        $this->assertInstanceOf(MarketInstrumentList::class, $etfs->getPayload());
        $this->assertEquals(2, $etfs->getPayload()->getTotal());
        $this->assertCount(2, $etfs->getPayload()->getInstruments());

        $instrument1 = $etfs->getPayload()->getInstruments()[0];

        $this->assertEquals('BBG333333333', $instrument1->getFigi());
        $this->assertEquals('TMOS', $instrument1->getTicker());
        $this->assertEquals('RU000A101X76', $instrument1->getIsin());
        $this->assertEquals('Тинькофф iMOEX', $instrument1->getName());
        $this->assertEquals('RUB', $instrument1->getCurrency());
        $this->assertEquals('Etf', $instrument1->getType());
        $this->assertEquals(0.002, $instrument1->getMinPriceIncrement());

        $instrument2 = $etfs->getPayload()->getInstruments()[1];

        $this->assertEquals('BBG00Q3HQJ74', $instrument2->getFigi());
        $this->assertEquals('AKEU', $instrument2->getTicker());
        $this->assertEquals('RU000A100Q43', $instrument2->getIsin());
        $this->assertEquals('Альфа-Капитал Европа 600', $instrument2->getName());
        $this->assertEquals('EUR', $instrument2->getCurrency());
        $this->assertEquals('Etf', $instrument2->getType());
        $this->assertEquals(0.01, $instrument2->getMinPriceIncrement());
    }

    public function testGetCurrencies()
    {
        $market = TinkoffInvest::create('test-token')
            ->setClient(ClientHelper::createClient('test-token', [
                'total' => 2,
                'instruments' => [
                    [
                        'figi' => 'BBG0013HGFT4',
                        'ticker' => 'USD000UTSTOM',
                        'isin' => '',
                        'minPriceIncrement' => 0.0025,
                        'lot' => 100,
                        'currency' => 'RUB',
                        'name' => 'Доллар США',
                        'type' => 'Currency',
                    ],
                    [
                        'figi' => 'BBG0013HJJ31',
                        'ticker' => 'EUR_RUB__TOM',
                        'isin' => '',
                        'minPriceIncrement' => 0.0025,
                        'lot' => 100,
                        'currency' => 'RUB',
                        'name' => 'Евро',
                        'type' => 'Currency',
                    ],
                ],
            ]))
            ->market();
        $currencies = $market->getCurrencies();

        $this->assertInstanceOf(MarketInstrumentListResponse::class, $currencies);
        $this->assertInstanceOf(MarketInstrumentList::class, $currencies->getPayload());
        $this->assertEquals(2, $currencies->getPayload()->getTotal());
        $this->assertCount(2, $currencies->getPayload()->getInstruments());

        $instrument1 = $currencies->getPayload()->getInstruments()[0];

        $this->assertEquals('BBG0013HGFT4', $instrument1->getFigi());
        $this->assertEquals('USD000UTSTOM', $instrument1->getTicker());
        $this->assertEquals('Доллар США', $instrument1->getName());
        $this->assertEquals('RUB', $instrument1->getCurrency());
        $this->assertEquals('Currency', $instrument1->getType());
        $this->assertEquals(0.0025, $instrument1->getMinPriceIncrement());

        $instrument2 = $currencies->getPayload()->getInstruments()[1];

        $this->assertEquals('BBG0013HJJ31', $instrument2->getFigi());
        $this->assertEquals('EUR_RUB__TOM', $instrument2->getTicker());
        $this->assertEquals('Евро', $instrument2->getName());
        $this->assertEquals('RUB', $instrument2->getCurrency());
        $this->assertEquals('Currency', $instrument2->getType());
        $this->assertEquals(0.0025, $instrument2->getMinPriceIncrement());
    }
}
