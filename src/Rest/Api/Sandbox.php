<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest\Api;

use Dzhdmitry\TinkoffInvestApi\Rest\ResponseDeserializer;
use Dzhdmitry\TinkoffInvestApi\Rest\Client;
use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Response\SandboxRegisterResponse;
use Dzhdmitry\TinkoffInvestApi\Rest\Schema\Response\EmptyResponse;
use GuzzleHttp\Exception\GuzzleException;

/**
 * @link https://tinkoffcreditsystems.github.io/invest-openapi/swagger-ui/#/sandbox
 */
class Sandbox
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
        $response = $this->client->request(
            'POST',
            '/sandbox/sandbox/register',
            [],
            [
                'brokerAccountType' => $brokerAccountType,
            ]
        );

        return $this->deserializer->deserialize($response, SandboxRegisterResponse::class);
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

        $response = $this->client->request(
            'POST',
            '/sandbox/sandbox/currencies/balance',
            $query,
            [
                'currency' => $currency,
                'balance' => $balance,
            ]
        );

        return $this->deserializer->deserialize($response, EmptyResponse::class);
    }

    /**
     * Выставление баланса по инструментным позициям
     *
     * @param string $figi
     * @param float $balance
     * @param string|null $brokerAccountId
     *
     * @return EmptyResponse
     *
     * @throws GuzzleException
     */
    public function postPositionsBalance(string $figi, float $balance, string $brokerAccountId = null): EmptyResponse
    {
        $query = [];

        if ($brokerAccountId !== null) {
            $query['brokerAccountId'] = $brokerAccountId;
        }

        $response = $this->client->request(
            'POST',
            '/sandbox/sandbox/positions/balance',
            $query,
            [
                'figi' => $figi,
                'balance' => $balance,
            ]
        );

        return $this->deserializer->deserialize($response, EmptyResponse::class);
    }

    /**
     * Удаление счета
     *
     * @param string|null $brokerAccountId
     *
     * @return EmptyResponse
     *
     * @throws GuzzleException
     */
    public function postRemove(string $brokerAccountId = null): EmptyResponse
    {
        $query = [];

        if ($brokerAccountId !== null) {
            $query['brokerAccountId'] = $brokerAccountId;
        }

        $response = $this->client->request(
            'POST',
            '/sandbox/sandbox/remove',
            $query
        );

        return $this->deserializer->deserialize($response, EmptyResponse::class);
    }

    /**
     * Удаление всех позиций
     *
     * @param string|null $brokerAccountId
     *
     * @return EmptyResponse
     *
     * @throws GuzzleException
     */
    public function postClear(string $brokerAccountId = null): EmptyResponse
    {
        $query = [];

        if ($brokerAccountId !== null) {
            $query['brokerAccountId'] = $brokerAccountId;
        }

        $response = $this->client->request(
            'POST',
            '/sandbox/sandbox/clear',
            $query
        );

        return $this->deserializer->deserialize($response, EmptyResponse::class);
    }
}
