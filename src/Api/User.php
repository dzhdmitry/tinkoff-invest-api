<?php

namespace Dzhdmitry\TinkoffInvestApi\Api;

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
     * @param RestClient $client
     */
    public function __construct(RestClient $client)
    {
        $this->client = $client;
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
        return $this->client->get('/openapi/user/accounts', UserAccountsResponse::class);
    }
}
