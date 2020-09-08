<?php

namespace Dzhdmitry\TinkoffInvestApi\Api;

use Dzhdmitry\TinkoffInvestApi\RestClient;
use Dzhdmitry\TinkoffInvestApi\RestClientFacade;
use Dzhdmitry\TinkoffInvestApi\Schema\CandlesResponse;
use Dzhdmitry\TinkoffInvestApi\Schema\MarketInstrumentListResponse;
use Dzhdmitry\TinkoffInvestApi\Schema\OrderbookResponse;
use Dzhdmitry\TinkoffInvestApi\Schema\SearchMarketInstrumentResponse;
use GuzzleHttp\Exception\GuzzleException;

/**
 * https://tinkoffcreditsystems.github.io/invest-openapi/swagger-ui/#/market
 */
class Market
{
    /**
     * @var RestClientFacade
     */
    private RestClientFacade $clientFacade;

    /**
     * @param RestClientFacade $clientFacade
     */
    public function __construct(RestClientFacade $clientFacade)
    {
        $this->clientFacade = $clientFacade;
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
        return $this->clientFacade->getAndSerialize('/openapi/market/stocks', MarketInstrumentListResponse::class);
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
        return $this->clientFacade->getAndSerialize('/openapi/market/bonds', MarketInstrumentListResponse::class);
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
        return $this->clientFacade->getAndSerialize('/openapi/market/etfs', MarketInstrumentListResponse::class);
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
        return $this->clientFacade->getAndSerialize('/openapi/market/currencies', MarketInstrumentListResponse::class);
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
        return $this->clientFacade->getAndSerialize('/openapi/market/orderbook', OrderbookResponse::class, [
            'figi' => $figi,
            'depth' => $depth,
        ]);
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
        return $this->clientFacade->getAndSerialize('/openapi/market/candles', CandlesResponse::class, [
            'figi' => $figi,
            'from' => $from->format(RestClient::REQUEST_DATE_FORMAT),
            'to' => $to->format(RestClient::REQUEST_DATE_FORMAT),
            'interval' => $interval,
        ]);
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
        return $this->clientFacade->getAndSerialize('/openapi/market/search/by-figi', SearchMarketInstrumentResponse::class, [
            'figi' => $figi,
        ]);
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
        return $this->clientFacade->getAndSerialize('/openapi/market/search/by-ticker', MarketInstrumentListResponse::class, [
            'ticker' => $ticker,
        ]);
    }
}
