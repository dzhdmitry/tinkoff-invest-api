<?php

namespace Dzhdmitry\TinkoffInvestApi\Api;

use Dzhdmitry\TinkoffInvestApi\ResponseDeserializer;
use Dzhdmitry\TinkoffInvestApi\RestClient;
use Dzhdmitry\TinkoffInvestApi\Schema\Response\OperationsResponse;
use GuzzleHttp\Exception\GuzzleException;

/**
 * https://tinkoffcreditsystems.github.io/invest-openapi/swagger-ui/#/operations
 */
class Operations
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
     * Получение списка операций
     *
     * @param \DateTimeInterface $from
     * @param \DateTimeInterface $to
     * @param string|null $figi
     * @param string|null $brokerAccountId
     *
     * @return OperationsResponse
     *
     * @throws GuzzleException
     */
    public function get(\DateTimeInterface $from, \DateTimeInterface $to, ?string $figi = null, string $brokerAccountId = null): OperationsResponse
    {
        $query = [
            'from' => $from->format(RestClient::REQUEST_DATE_FORMAT),
            'to' => $to->format(RestClient::REQUEST_DATE_FORMAT),
        ];

        if ($figi !== null) {
            $query['figi'] = $figi;
        }

        if ($brokerAccountId !== null) {
            $query['brokerAccountId'] = $brokerAccountId;
        }

        $response = $this->client->request('GET', '/operations', $query);

        return $this->deserializer->deserialize($response, OperationsResponse::class);
    }
}
