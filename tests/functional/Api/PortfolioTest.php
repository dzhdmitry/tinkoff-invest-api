<?php

namespace Dzhdmitry\TinkoffInvestApi\Tests\functional\Api;

use Dzhdmitry\TinkoffInvestApi\RestClientFactory;
use Dzhdmitry\TinkoffInvestApi\Schema\Enum\Currency;
use Dzhdmitry\TinkoffInvestApi\Schema\Enum\InstrumentType;
use Dzhdmitry\TinkoffInvestApi\Schema\Response\CurrenciesResponse;
use Dzhdmitry\TinkoffInvestApi\Schema\Payload\Currencies;
use Dzhdmitry\TinkoffInvestApi\Schema\Payload\Portfolio;
use Dzhdmitry\TinkoffInvestApi\Schema\Response\PortfolioResponse;
use Dzhdmitry\TinkoffInvestApi\Tests\ClientHelper;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class PortfolioTest extends TestCase
{
    /**
     * @dataProvider positionsGetDataProvider
     *
     * @param string|null $brokerAccountId
     * @param array $clientResponse
     *
     * @throws GuzzleException
     */
    public function testGet(?string $brokerAccountId, array $clientResponse)
    {
        $portfolio = (new RestClientFactory())->create('test-token')
            ->setHttpClient(ClientHelper::createClient($clientResponse))
            ->portfolio();

        $response = $portfolio->get($brokerAccountId);

        $this->assertInstanceOf(PortfolioResponse::class, $response);
        $this->assertInstanceOf(Portfolio::class, $response->getPayload());
        $this->assertCount(3, $response->getPayload()->getPositions());

        $position1 = $response->getPayload()->getPositions()[0];

        $this->assertEquals('BBG000DHPN63', $position1->getFigi());
        $this->assertEquals(InstrumentType::STOCK, $position1->getInstrumentType());
        $this->assertEquals(3.0, $position1->getBalance());
        $this->assertEquals(0.0, $position1->getBlocked());
        $this->assertEquals(5, $position1->getLots());
        $this->assertEquals('Realty Income', $position1->getName());
        $this->assertEquals('O', $position1->getTicker());
        $this->assertEquals('US7561091049', $position1->getIsin());
        $this->assertEquals(33.59, $position1->getExpectedYield()->getValue());
        $this->assertEquals(Currency::USD, $position1->getExpectedYield()->getCurrency());
        $this->assertEquals(53.07, $position1->getAveragePositionPrice()->getValue());
        $this->assertEquals(Currency::USD, $position1->getAveragePositionPrice()->getCurrency());

        $position2 = $response->getPayload()->getPositions()[1];

        $this->assertEquals('BBG00RRT3TX4', $position2->getFigi());
        $this->assertEquals(InstrumentType::BOND, $position2->getInstrumentType());
        $this->assertEquals(1.0, $position2->getBalance());
        $this->assertEquals(0.0, $position2->getBlocked());
        $this->assertEquals(1, $position2->getLots());
        $this->assertEquals('ОФЗ 25084', $position2->getName());
        $this->assertEquals('SU25084RMFS3', $position2->getTicker());
        $this->assertEquals(44.99, $position2->getExpectedYield()->getValue());
        $this->assertEquals(Currency::RUB, $position2->getExpectedYield()->getCurrency());
        $this->assertEquals(996.96, $position2->getAveragePositionPrice()->getValue());
        $this->assertEquals(Currency::RUB, $position2->getAveragePositionPrice()->getCurrency());

        $position3 = $response->getPayload()->getPositions()[2];

        $this->assertEquals('BBG0013HGFT4', $position3->getFigi());
        $this->assertEquals(InstrumentType::CURRENCY, $position3->getInstrumentType());
        $this->assertEquals(26.89, $position3->getBalance());
        $this->assertEquals(0.25, $position3->getBlocked());
        $this->assertEquals(0, $position3->getLots());
        $this->assertEquals('Доллар США', $position3->getName());
        $this->assertEquals('USD000UTSTOM', $position3->getTicker());
        $this->assertEquals(3.36, $position3->getExpectedYield()->getValue());
        $this->assertEquals(Currency::RUB, $position3->getExpectedYield()->getCurrency());
        $this->assertEquals(76.135, $position3->getAveragePositionPrice()->getValue());
        $this->assertEquals(Currency::RUB, $position3->getAveragePositionPrice()->getCurrency());
    }

    public function testGetCurrencies()
    {
        $portfolio = (new RestClientFactory())->create('test-token')
            ->setHttpClient(ClientHelper::createClient([
                'currencies' => [
                    [
                        'currency' => 'RUB',
                        'balance' => 100.5,
                        'blocked' => null,
                    ],
                    [
                        'currency' => 'USD',
                        'balance' => 50.0,
                        'blocked' => 2.3,
                    ],
                ],
            ]))
            ->portfolio();

        $response = $portfolio->getCurrencies('account-id');

        $this->assertInstanceOf(CurrenciesResponse::class, $response);
        $this->assertInstanceOf(Currencies::class, $response->getPayload());
        $this->assertCount(2, $response->getPayload()->getCurrencies());

        $currency1 = $response->getPayload()->getCurrencies()[0];
        $this->assertEquals(Currency::RUB, $currency1->getCurrency());
        $this->assertEquals(100.5, $currency1->getBalance());
        $this->assertEquals(null, $currency1->getBlocked());

        $currency2 = $response->getPayload()->getCurrencies()[1];
        $this->assertEquals(Currency::USD, $currency2->getCurrency());
        $this->assertEquals(50.0, $currency2->getBalance());
        $this->assertEquals(2.3, $currency2->getBlocked());
    }

    /**
     * @return array
     */
    public function positionsGetDataProvider(): array
    {
        $positions = [
            'positions' => [
                [
                    'figi' => 'BBG000DHPN63',
                    'instrumentType' => 'Stock',
                    'balance' => 3.0,
                    'blocked' => 0.0,
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
                    'blocked' => 0.0,
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
                    'blocked' => 0.25,
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
        ];

        return [
            ['account-id', $positions],
            [null, $positions],
        ];
    }
}
