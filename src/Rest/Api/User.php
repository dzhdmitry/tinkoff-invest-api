<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest\Api;

use Dzhdmitry\TinkoffInvestApi\Rest\ResponseDeserializer;
use Dzhdmitry\TinkoffInvestApi\Rest\Client;
use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Response\UserAccountsResponse;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

/**
 * @link https://tinkoffcreditsystems.github.io/invest-openapi/swagger-ui/#/user
 */
class User
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
