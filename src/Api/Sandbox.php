<?php

namespace Dzhdmitry\TinkoffInvestApi\Api;

use Dzhdmitry\TinkoffInvestApi\RestClientFacade;
use Dzhdmitry\TinkoffInvestApi\Schema\SandboxRegisterResponse;
use Dzhdmitry\TinkoffInvestApi\Schema\EmptyResponse;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

/**
 * @link https://tinkoffcreditsystems.github.io/invest-openapi/swagger-ui/#/sandbox
 */
class Sandbox
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
     * Регистрация клиента в sandbox
     *
     * @param string|null $brokerAccountType
     *
     * @return SandboxRegisterResponse
     *
     * @throws RequestException
     * @throws GuzzleException
     */
    public function postRegister(?string $brokerAccountType = null): SandboxRegisterResponse
    {
        return $this->clientFacade->postAndSerialize('/openapi/sandbox/sandbox/register', SandboxRegisterResponse::class, [], [
            'brokerAccountType' => $brokerAccountType,
        ]);
    }

    /**
     * Выставление баланса по валютным позициям
     *
     * @param string $currency
     * @param float $balance
     *
     * @return EmptyResponse
     *
     * @throws RequestException
     * @throws GuzzleException
     */
    public function postCurrenciesBalance(string $currency, float $balance): EmptyResponse
    {
        return $this->clientFacade->postAndSerialize('/openapi/sandbox/sandbox/currencies/balance', EmptyResponse::class, [], [
            'currency' => $currency,
            'balance' => $balance,
        ]);
    }
}
