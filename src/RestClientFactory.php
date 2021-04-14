<?php

namespace Dzhdmitry\TinkoffInvestApi;

use GuzzleHttp\Client;

class RestClientFactory
{
    private const URL = 'https://api-invest.tinkoff.ru/openapi';
    private const URL_SANDBOX = 'https://api-invest.tinkoff.ru/openapi/sandbox';

    /**
     * Создать REST клиент для биржи
     *
     * @param string $token
     *
     * @return RestClient
     */
    public function create(string $token): RestClient
    {
        return $this->createRest($token, self::URL);
    }

    /**
     * Создать REST клиент для sandbox
     *
     * @param string $token
     *
     * @return RestClient
     */
    public function createSandbox(string $token): RestClient
    {
        return $this->createRest($token, self::URL_SANDBOX);
    }

    /**
     * @param string $token
     * @param string $baseUri
     *
     * @return RestClient
     */
    private function createRest(string $token, string $baseUri): RestClient
    {
        $httpClient = new Client([
            'base_uri' => $baseUri,
        ]);

        $deserializer = (new ResponseDeserializerFactory())->create();

        return new RestClient($token, $httpClient, $deserializer);
    }
}
