<?php

namespace Dzhdmitry\TinkoffInvestApi\Api;

use Dzhdmitry\TinkoffInvestApi\RestClientFacade;
use Dzhdmitry\TinkoffInvestApi\Schema\Response\UserAccountsResponse;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

/**
 * @link https://tinkoffcreditsystems.github.io/invest-openapi/swagger-ui/#/user
 */
class User
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
        return $this->clientFacade->getAndSerialize('/openapi/user/accounts', UserAccountsResponse::class);
    }
}
