<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest\Api;

use Dzhdmitry\TinkoffInvestApi\Rest\ResponseDeserializer;
use Dzhdmitry\TinkoffInvestApi\Rest\Client;
use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Response\CandlesResponse;
use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Response\MarketInstrumentListResponse;
use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Response\OrderbookResponse;
use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Response\SearchMarketInstrumentResponse;
use GuzzleHttp\Exception\GuzzleException;

/**
 * https://tinkoffcreditsystems.github.io/invest-openapi/swagger-ui/#/market
 */
class Market
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * @var ResponseDeserializer
     */
    private ResponseDeserializer $deserializer;

    /**
     * @param Client $client
     * @param ResponseDeserializer $deserializer
     */
    public function __construct(Client $client, ResponseDeserializer $deserializer)
    {
        $this->client = $client;
        $this->deserializer = $deserializer;
    }

    /**
     * Получение списка акций
     *
     * @return MarketInstrumentListResponse
     *
     * @throws GuzzleException
     */
    public function getStocks(): MarketInstrumentListResponse
    {
        $response = $this->client->request('GET', '/market/stocks');

        return $this->deserializer->deserialize($response, MarketInstrumentListResponse::class);
    }

    /**
     * Получение списка облигаций
     *
     * @return MarketInstrumentListResponse
     *
     * @throws GuzzleException
     */
    public function getBonds(): MarketInstrumentListResponse
    {
        $response = $this->client->request('GET', '/market/bonds');

        return $this->deserializer->deserialize($response, MarketInstrumentListResponse::class);
    }

    /**
     * Получение списка ETF
     *
     * @return MarketInstrumentListResponse
     *
     * @throws GuzzleException
     */
    public function getEtfs(): MarketInstrumentListResponse
    {
        $response = $this->client->request('GET', '/market/etfs');

        return $this->deserializer->deserialize($response, MarketInstrumentListResponse::class);
    }

    /**
     * Получение списка валютных пар
     *
     * @return MarketInstrumentListResponse
     *
     * @throws GuzzleException
     */
    public function getCurrencies(): MarketInstrumentListResponse
    {
        $response = $this->client->request('GET', '/market/currencies');

        return $this->deserializer->deserialize($response, MarketInstrumentListResponse::class);
    }

    /**
     * Получение стакана по FIGI
     *
     * @param string $figi
     * @param int $depth
     *
     * @return OrderbookResponse
     *
     * @throws GuzzleException
     */
    public function getOrderbook(string $figi, int $depth): OrderbookResponse
    {
        $response = $this->client->request('GET', '/market/orderbook', [
            'figi' => $figi,
            'depth' => $depth,
        ]);

        return $this->deserializer->deserialize($response, OrderbookResponse::class);
    }

    /**
     * Получение исторических свечей по FIGI
     *
     * @param string $figi
     * @param \DateTimeInterface $from
     * @param \DateTimeInterface $to
     * @param string $interval
     *
     * @return CandlesResponse
     *
     * @throws GuzzleException
     */
    public function getCandles(string $figi, \DateTimeInterface $from, \DateTimeInterface $to, string $interval): CandlesResponse
    {
        $response = $this->client->request('GET', '/market/candles', [
            'figi' => $figi,
            'from' => $from->format(Client::REQUEST_DATE_FORMAT),
            'to' => $to->format(Client::REQUEST_DATE_FORMAT),
            'interval' => $interval,
        ]);

        return $this->deserializer->deserialize($response, CandlesResponse::class);
    }

    /**
     * Получение инструмента по FIGI
     *
     * @param string $figi
     *
     * @return SearchMarketInstrumentResponse
     *
     * @throws GuzzleException
     */
    public function searchByFigi(string $figi): SearchMarketInstrumentResponse
    {
        $response = $this->client->request('GET', '/market/search/by-figi', [
            'figi' => $figi,
        ]);

        return $this->deserializer->deserialize($response, SearchMarketInstrumentResponse::class);
    }

    /**
     * Получение инструмента по тикеру
     *
     * @param string $ticker
     *
     * @return MarketInstrumentListResponse
     *
     * @throws GuzzleException
     */
    public function searchByTicker(string $ticker): MarketInstrumentListResponse
    {
        $response = $this->client->request('GET', '/market/search/by-ticker', [
            'ticker' => $ticker,
        ]);

        return $this->deserializer->deserialize($response, MarketInstrumentListResponse::class);
    }
}
