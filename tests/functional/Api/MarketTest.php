<?php

namespace Dzhdmitry\TinkoffInvestApi\Tests\functional\Api;

use Dzhdmitry\TinkoffInvestApi\Schema\CandlesResponse;
use Dzhdmitry\TinkoffInvestApi\Schema\MarketInstrumentListResponse;
use Dzhdmitry\TinkoffInvestApi\Schema\OrderbookResponse;
use Dzhdmitry\TinkoffInvestApi\Schema\Payload\Candles;
use Dzhdmitry\TinkoffInvestApi\Schema\Payload\MarketInstrumentList;
use Dzhdmitry\TinkoffInvestApi\Schema\Payload\Orderbook;
use Dzhdmitry\TinkoffInvestApi\Schema\Payload\SearchMarketInstrument;
use Dzhdmitry\TinkoffInvestApi\Schema\SearchMarketInstrumentResponse;
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

    public function testGetOrderbook()
    {
        $market = TinkoffInvest::create('test-token')
            ->setClient(ClientHelper::createClient('test-token', [
                'figi' => 'BBG0013HGFT4',
                'depth' => 2,
                'closePrice' => 76.39,
                'lastPrice' => 76.265,
                'limitDown' => 73.595,
                'limitUp' => 78.7675,
                'minPriceIncrement' => 0.0025,
                'faceValue' => null,
                'tradeStatus' => 'NormalTrading',
                'bids' => [
                    [
                        'price' => 76.2925,
                        'quantity' => 100,
                    ],
                    [
                        'price' => 76.29,
                        'quantity' => 150,
                    ],
                ],
                'asks' => [
                    [
                        'price' => 76.28,
                        'quantity' => 100,
                    ],
                    [
                        'price' => 76.2775,
                        'quantity' => 350,
                    ],
                ],
            ]))
            ->market();

        $response = $market->getOrderbook('BBG0013HGFT4', 2);
        $orderbook = $response->getPayload();

        $this->assertInstanceOf(OrderbookResponse::class, $response);
        $this->assertInstanceOf(Orderbook::class, $orderbook);

        $this->assertEquals('BBG0013HGFT4', $orderbook->getFigi());
        $this->assertEquals(76.39, $orderbook->getClosePrice());
        $this->assertEquals(2, $orderbook->getDepth());
        $this->assertEquals(76.265, $orderbook->getLastPrice());
        $this->assertEquals(73.595, $orderbook->getLimitDown());
        $this->assertEquals(78.7675, $orderbook->getLimitUp());
        $this->assertEquals(0.0025, $orderbook->getMinPriceIncrement());
        $this->assertNull($orderbook->getFaceValue());
        $this->assertEquals('NormalTrading', $orderbook->getTradeStatus());

        $this->assertCount(2, $orderbook->getBids());
        $this->assertCount(2, $orderbook->getAsks());

        $this->assertEquals(76.2925, $orderbook->getBids()[0]->getPrice());
        $this->assertEquals(100, $orderbook->getBids()[0]->getQuantity());

        $this->assertEquals(76.29, $orderbook->getBids()[1]->getPrice());
        $this->assertEquals(150, $orderbook->getBids()[1]->getQuantity());

        $this->assertEquals(76.28, $orderbook->getAsks()[0]->getPrice());
        $this->assertEquals(100, $orderbook->getAsks()[0]->getQuantity());

        $this->assertEquals(76.2775, $orderbook->getAsks()[1]->getPrice());
        $this->assertEquals(350, $orderbook->getAsks()[1]->getQuantity());
    }

    public function testGetCandles()
    {
        $market = TinkoffInvest::create('test-token')
            ->setClient(ClientHelper::createClient('test-token', [
                'figi' => 'BBG0013HGFT4',
                'interval' => '1min',
                'candles' => [
                    [
                        'figi' => 'BBG0013HGFT4',
                        'interval' => '1min',
                        'o' => 76.2925,
                        'c' => 76.28,
                        'h' => 76.2925,
                        'l' => 76.28,
                        'v' => 3099,
                        'time' => '2021-04-06T06:50:00+00:00',
                    ],
                    [
                        'figi' => 'BBG0013HGFT4',
                        'interval' => '1min',
                        'o' => 76.285,
                        'c' => 76.3175,
                        'h' => 76.2925,
                        'l' => 76.28,
                        'v' => 2381,
                        'time' => '2021-04-06T06:51:00+00:00',
                    ],
                    [
                        'figi' => 'BBG0013HGFT4',
                        'interval' => '1min',
                        'o' => 76.3175,
                        'c' => 76.3175,
                        'h' => 76.33,
                        'l' => 76.3025,
                        'v' => 1331,
                        'time' => '2021-04-06T06:52:00+00:00',
                    ],
                ],
            ]))
            ->market();

        $response = $market->getCandles(
            'BBG0013HGFT4',
            new \DateTimeImmutable('2021-04-06T09:50:00+03:00'),
            new \DateTimeImmutable('2021-04-06T09:53:00+03:00'),
            '1min'
        );
        $candles = $response->getPayload();

        $this->assertInstanceOf(CandlesResponse::class, $response);
        $this->assertInstanceOf(Candles::class, $candles);

        $this->assertEquals('BBG0013HGFT4', $candles->getFigi());
        $this->assertEquals('1min', $candles->getInterval());

        $this->assertCount(3, $candles->getCandles());

        $this->assertEquals('BBG0013HGFT4', $candles->getCandles()[0]->getFigi());
        $this->assertEquals('1min', $candles->getCandles()[0]->getInterval());
        $this->assertEquals(76.2925, $candles->getCandles()[0]->getO());
        $this->assertEquals(76.28, $candles->getCandles()[0]->getC());
        $this->assertEquals(76.2925, $candles->getCandles()[0]->getH());
        $this->assertEquals(76.28, $candles->getCandles()[0]->getL());
        $this->assertEquals(3099, $candles->getCandles()[0]->getV());
        $this->assertEquals('2021-04-06 06:50:00', $candles->getCandles()[0]->getTime()->format('Y-m-d H:i:s'));

        $this->assertEquals('BBG0013HGFT4', $candles->getCandles()[1]->getFigi());
        $this->assertEquals('1min', $candles->getCandles()[1]->getInterval());
        $this->assertEquals(76.285, $candles->getCandles()[1]->getO());
        $this->assertEquals(76.3175, $candles->getCandles()[1]->getC());
        $this->assertEquals(76.2925, $candles->getCandles()[1]->getH());
        $this->assertEquals(76.28, $candles->getCandles()[1]->getL());
        $this->assertEquals(2381, $candles->getCandles()[1]->getV());
        $this->assertEquals('2021-04-06 06:51:00', $candles->getCandles()[1]->getTime()->format('Y-m-d H:i:s'));

        $this->assertEquals('BBG0013HGFT4', $candles->getCandles()[2]->getFigi());
        $this->assertEquals('1min', $candles->getCandles()[2]->getInterval());
        $this->assertEquals(76.3175, $candles->getCandles()[2]->getO());
        $this->assertEquals(76.3175, $candles->getCandles()[2]->getC());
        $this->assertEquals(76.33, $candles->getCandles()[2]->getH());
        $this->assertEquals(76.3025, $candles->getCandles()[2]->getL());
        $this->assertEquals(1331, $candles->getCandles()[2]->getV());
        $this->assertEquals('2021-04-06 06:52:00', $candles->getCandles()[2]->getTime()->format('Y-m-d H:i:s'));
    }

    public function testSearchByFigi()
    {
        $market = TinkoffInvest::create('test-token')
            ->setClient(ClientHelper::createClient('test-token', [
                'figi' => 'BBG0013HGFT4',
                'ticker' => 'USD000UTSTOM',
                'isin' => '',
                'minPriceIncrement' => 0.0025,
                'lot' => 1000,
                'currency' => 'RUB',
                'name' => 'Доллар США',
                'type' => 'Currency',
            ]))
            ->market();

        $response = $market->searchByFigi('BBG0013HGFT4');
        $searchMarketInstrument = $response->getPayload();

        $this->assertInstanceOf(SearchMarketInstrumentResponse::class, $response);
        $this->assertInstanceOf(SearchMarketInstrument::class, $searchMarketInstrument);

        $this->assertEquals('BBG0013HGFT4', $searchMarketInstrument->getFigi());
        $this->assertEquals('USD000UTSTOM', $searchMarketInstrument->getTicker());
        $this->assertEquals('', $searchMarketInstrument->getIsin());
        $this->assertEquals(0.0025, $searchMarketInstrument->getMinPriceIncrement());
        $this->assertEquals(1000, $searchMarketInstrument->getLot());
        $this->assertEquals('RUB', $searchMarketInstrument->getCurrency());
        $this->assertEquals('Доллар США', $searchMarketInstrument->getName());
        $this->assertEquals('Currency', $searchMarketInstrument->getType());
    }

    public function testSearchByTicker()
    {
        $market = TinkoffInvest::create('test-token')
            ->setClient(ClientHelper::createClient('test-token', [
                'total' => 1,
                'instruments' => [
                    [
                        'figi' => 'BBG0013HGFT4',
                        'ticker' => 'USD000UTSTOM',
                        'isin' => '',
                        'minPriceIncrement' => 0.0025,
                        'minQuantity' => 1,
                        'lot' => 1000,
                        'currency' => 'RUB',
                        'name' => 'Доллар США',
                        'type' => 'Currency',
                    ],
                ],
            ]))
            ->market();

        $response = $market->searchByTicker('USD000UTSTOM');
        $marketInstrumentList = $response->getPayload();

        $this->assertInstanceOf(MarketInstrumentListResponse::class, $response);
        $this->assertInstanceOf(MarketInstrumentList::class, $marketInstrumentList);

        $this->assertEquals(1, $marketInstrumentList->getTotal());
        $this->assertCount(1, $marketInstrumentList->getInstruments());

        $instrument = $marketInstrumentList->getInstruments()[0];

        $this->assertEquals('BBG0013HGFT4', $instrument->getFigi());
        $this->assertEquals('USD000UTSTOM', $instrument->getTicker());
        $this->assertEquals('', $instrument->getIsin());
        $this->assertEquals(0.0025, $instrument->getMinPriceIncrement());
        $this->assertEquals(1, $instrument->getMinQuantity());
        $this->assertEquals(1000, $instrument->getLot());
        $this->assertEquals('RUB', $instrument->getCurrency());
        $this->assertEquals('Доллар США', $instrument->getName());
        $this->assertEquals('Currency', $instrument->getType());
    }
}
