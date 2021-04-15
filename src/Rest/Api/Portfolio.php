<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest\Api;

use Dzhdmitry\TinkoffInvestApi\Rest\ResponseDeserializer;
use Dzhdmitry\TinkoffInvestApi\Rest\Client;
use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Response\CurrenciesResponse;
use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Response\PortfolioResponse;
use GuzzleHttp\Exception\GuzzleException;

/**
 * @link https://tinkoffcreditsystems.github.io/invest-openapi/swagger-ui/#/portfolio
 */
class Portfolio
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
