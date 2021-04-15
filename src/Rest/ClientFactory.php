<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest;

use GuzzleHttp\Client as HttpClient;

class ClientFactory
{
    private const URL = 'https://api-invest.tinkoff.ru/openapi';
    private const URL_SANDBOX = 'https://api-invest.tinkoff.ru/openapi/sandbox';

    /**
     * Создать REST клиент для биржи
     *
     * @param string $token
     *
     * @return Client
     */
    public function create(string $token): Client
    {
        return $this->createClient($token, self::URL);
    }

    /**
     * Создать REST клиент для sandbox
     *
     * @param string $token
     *
     * @return Client
     */
    public function createSandbox(string $token): Client
    {
        return $this->createClient($token, self::URL_SANDBOX);
    }

    /**
     * @param string $token
     * @param string $baseUri
     *
     * @return Client
     */
    private function createClient(string $token, string $baseUri): Client
    {
        $httpClient = new HttpClient([
            'base_uri' => $baseUri,
        ]);
        $deserializer = (new ResponseDeserializerFactory())->create();

        return new Client($token, $httpClient, $deserializer);
    }
}
