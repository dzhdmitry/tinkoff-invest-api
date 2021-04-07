<?php

namespace Dzhdmitry\TinkoffInvestApi\Api;

use Dzhdmitry\TinkoffInvestApi\RestClient;
use Dzhdmitry\TinkoffInvestApi\Schema\Response\SandboxRegisterResponse;
use Dzhdmitry\TinkoffInvestApi\Schema\Response\EmptyResponse;
use GuzzleHttp\Exception\GuzzleException;

/**
 * @link https://tinkoffcreditsystems.github.io/invest-openapi/swagger-ui/#/sandbox
 */
class Sandbox
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
     * Регистрация клиента в sandbox
     *
     * @param string|null $brokerAccountType
     *
     * @return SandboxRegisterResponse
     *
     * @throws GuzzleException
     */
    public function postRegister(?string $brokerAccountType = null): SandboxRegisterResponse
    {
        return $this->client->post('/openapi/sandbox/sandbox/register', SandboxRegisterResponse::class, [], [
            'brokerAccountType' => $brokerAccountType,
        ]);
    }

    /**
     * Выставление баланса по валютным позициям
     *
     * @param string $currency
     * @param float $balance
     * @param string|null $brokerAccountId
     *
     * @return EmptyResponse
     *
     * @throws GuzzleException
     */
    public function postCurrenciesBalance(string $currency, float $balance, string $brokerAccountId = null): EmptyResponse
    {
        $query = [];

        if ($brokerAccountId !== null) {
            $query['brokerAccountId'] = $brokerAccountId;
        }

        return $this->client->post(
            '/openapi/sandbox/currencies/balance',
            EmptyResponse::class,
            $query,
            [
                'currency' => $currency,
                'balance' => $balance,
            ]
        );
    }
}
