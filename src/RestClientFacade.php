<?php

namespace Dzhdmitry\TinkoffInvestApi;

use GuzzleHttp\Exception\GuzzleException;

class RestClientFacade
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
     * @var string|null
     */
    private ?string $brokerAccountId;

    /**
     * @param RestClient $client
     * @param ResponseDeserializer $deserializer
     * @param string|null $brokerAccountId
     */
    public function __construct(RestClient $client, ResponseDeserializer $deserializer, ?string $brokerAccountId = null)
    {
        $this->client = $client;
        $this->deserializer = $deserializer;
        $this->brokerAccountId = $brokerAccountId;
    }

    /**
     * @param string $uri
     * @param string $type
     * @param array $query
     *
     * @return mixed
     *
     * @throws GuzzleException
     */
    public function getAndSerialize(string $uri, string $type, array $query = [])
    {
        if ($this->brokerAccountId !== null) {
            $query['brokerAccountId'] = $this->brokerAccountId;
        }

        $response = $this->client->request('GET', $uri, $query);

        return $this->deserializer->deserialize($response->getBody()->getContents(), $type);
    }

    /**
     * @param string $uri
     * @param string $type
     * @param array $query
     * @param array $body
     *
     * @return mixed
     *
     * @throws GuzzleException
     */
    public function postAndSerialize(string $uri, string $type, array $query = [], array $body = [])
    {
        if ($this->brokerAccountId !== null) {
            $query['brokerAccountId'] = $this->brokerAccountId;
        }

        $response = $this->client->request('POST', $uri, $query, $body);

        return $this->deserializer->deserialize($response->getBody()->getContents(), $type);
    }
}
