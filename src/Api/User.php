<?php

namespace Dzhdmitry\TinkoffInvestApi\Api;

use Dzhdmitry\TinkoffInvestApi\ResponseDeserializer;
use Dzhdmitry\TinkoffInvestApi\RestClient;
use Dzhdmitry\TinkoffInvestApi\Schema\Response\UserAccountsResponse;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

/**
 * @link https://tinkoffcreditsystems.github.io/invest-openapi/swagger-ui/#/user
 */
class User
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
     * Получение брокерских счетов клиента
     *
     * @return UserAccountsResponse
     *
     * @throws RequestException
     *
     * @throws GuzzleException
     */
    public function getAccounts(): UserAccountsResponse
    {
        $response = $this->client->request('GET', '/user/accounts');

        return $this->deserializer->deserialize($response, UserAccountsResponse::class);
    }
}
