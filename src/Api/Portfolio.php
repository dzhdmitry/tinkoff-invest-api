<?php

namespace Dzhdmitry\TinkoffInvestApi\Api;

use Dzhdmitry\TinkoffInvestApi\RestClientFacade;
use Dzhdmitry\TinkoffInvestApi\Schema\CurrenciesResponse;
use Dzhdmitry\TinkoffInvestApi\Schema\PortfolioResponse;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

/**
 * @link https://tinkoffcreditsystems.github.io/invest-openapi/swagger-ui/#/portfolio
 */
class Portfolio
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
     * Получение портфеля клиента
     *
     * @return PortfolioResponse
     *
     * @throws RequestException
     * @throws GuzzleException
     */
    public function get(): PortfolioResponse
    {
        return $this->clientFacade->getAndSerialize('/openapi/portfolio', PortfolioResponse::class);
    }

    /**
     * Получение валютных активов клиента
     *
     * @return CurrenciesResponse
     *
     * @throws RequestException
     * @throws GuzzleException
     */
    public function getCurrencies(): CurrenciesResponse
    {
        return $this->clientFacade->getAndSerialize('/openapi/portfolio/currencies', CurrenciesResponse::class);
    }
}
