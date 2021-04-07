<?php

namespace Dzhdmitry\TinkoffInvestApi\Api;

use Dzhdmitry\TinkoffInvestApi\RestClient;
use Dzhdmitry\TinkoffInvestApi\Schema\Response\CurrenciesResponse;
use Dzhdmitry\TinkoffInvestApi\Schema\Response\PortfolioResponse;
use GuzzleHttp\Exception\GuzzleException;

/**
 * @link https://tinkoffcreditsystems.github.io/invest-openapi/swagger-ui/#/portfolio
 */
class Portfolio
{
    /**
     * @var RestClient
     */
    private RestClient $client;

    /**
     * @param RestClient $client
     */
    public function __construct(RestClient $client)
    {
        $this->client = $client;
    }

    /**
     * Получение портфеля клиента
     *
     * @param string|null $brokerAccountId
     *
     * @return PortfolioResponse
     *
     * @throws GuzzleException
     */
    public function get(string $brokerAccountId = null): PortfolioResponse
    {
        $query = [];

        if ($brokerAccountId !== null) {
            $query['brokerAccountId'] = $brokerAccountId;
        }

        return $this->client->get('/openapi/portfolio', PortfolioResponse::class, $query);
    }

    /**
     * Получение валютных активов клиента
     *
     * @param string|null $brokerAccountId
     *
     * @return CurrenciesResponse
     *
     * @throws GuzzleException
     */
    public function getCurrencies(string $brokerAccountId = null): CurrenciesResponse
    {
        $query = [];

        if ($brokerAccountId !== null) {
            $query['brokerAccountId'] = $brokerAccountId;
        }

        return $this->client->get('/openapi/portfolio/currencies', CurrenciesResponse::class, $query);
    }
}
