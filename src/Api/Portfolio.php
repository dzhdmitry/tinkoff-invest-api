<?php

namespace Dzhdmitry\TinkoffInvestApi\Api;

use Dzhdmitry\TinkoffInvestApi\ResponseDeserializer;
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
     * @var ResponseDeserializer
     */
    private ResponseDeserializer $deserializer;

    /**
     * @param RestClient $client
     * @param ResponseDeserializer $deserializer
     */
    public function __construct(RestClient $client, ResponseDeserializer $deserializer)
    {
        $this->client = $client;
        $this->deserializer = $deserializer;
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

        $response = $this->client->request('GET', '/portfolio', $query);

        return $this->deserializer->deserialize($response, PortfolioResponse::class);
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

        $response = $this->client->request('GET', '/portfolio/currencies', $query);

        return $this->deserializer->deserialize($response, CurrenciesResponse::class);
    }
}
