<?php

namespace Dzhdmitry\TinkoffInvestApi\Api;

use Dzhdmitry\TinkoffInvestApi\RestClient;
use Dzhdmitry\TinkoffInvestApi\RestClientFacade;
use Dzhdmitry\TinkoffInvestApi\Schema\OperationsResponse;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

/**
 * https://tinkoffcreditsystems.github.io/invest-openapi/swagger-ui/#/operations
 */
class Operations
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
     * Получение списка операций
     *
     * @param \DateTimeInterface $from
     * @param \DateTimeInterface $to
     * @param string|null $figi
     *
     * @return OperationsResponse
     *
     * @throws RequestException
     * @throws GuzzleException
     */
    public function get(\DateTimeInterface $from, \DateTimeInterface $to, ?string $figi = null): OperationsResponse
    {
        $query = [
            'from' => $from->format(RestClient::REQUEST_DATE_FORMAT),
            'to' => $to->format(RestClient::REQUEST_DATE_FORMAT),
        ];

        if ($figi !== null) {
            $query['figi'] = $figi;
        }

        return $this->clientFacade->getAndSerialize('/openapi/operations', OperationsResponse::class, $query);
    }
}
