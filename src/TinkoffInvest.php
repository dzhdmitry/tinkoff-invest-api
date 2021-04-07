<?php

namespace Dzhdmitry\TinkoffInvestApi;

use Dzhdmitry\TinkoffInvestApi\Api\Market;
use Dzhdmitry\TinkoffInvestApi\Api\Operations;
use Dzhdmitry\TinkoffInvestApi\Api\Orders;
use Dzhdmitry\TinkoffInvestApi\Api\Portfolio;
use Dzhdmitry\TinkoffInvestApi\Api\Sandbox;
use Dzhdmitry\TinkoffInvestApi\Api\User;
use Dzhdmitry\TinkoffInvestApi\Schema\Payload as Types;
use Dzhdmitry\TinkoffInvestApi\Schema\Response\OrdersResponse;
use GuzzleHttp\Client;

class TinkoffInvest
{
    private const BASE_URI = 'https://api-invest.tinkoff.ru';

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
     * @param string $token
     *
     * @return TinkoffInvest
     */
    public static function create(string $token): TinkoffInvest
    {
        $httpClient = new Client([
            'base_uri' => self::BASE_URI,
        ]);
        $deserializer = (new SerializerFactory())->create();
        $client = new RestClient($token, $httpClient, $deserializer);

        return new self($client);
    }

    /**
     * @return Market
     */
    public function market(): Market
    {
        return new Market($this->client);
    }

    /**
     * @return Operations
     */
    public function operations(): Operations
    {
        return new Operations($this->client);
    }

    /**
     * @return Orders
     */
    public function orders(): Orders
    {
        return new Orders($this->client);
    }

    /**
     * @return Portfolio
     */
    public function portfolio(): Portfolio
    {
        return new Portfolio($this->client);
    }

    /**
     * @return Sandbox
     */
    public function sandbox(): Sandbox
    {
        return new Sandbox($this->client);
    }

    /**
     * @return User
     */
    public function user(): User
    {
        return new User($this->client);
    }

    /**
     * @return RestClient
     */
    public function getClient(): RestClient
    {
        return $this->client;
    }

    /**
     * @param RestClient $client
     *
     * @return TinkoffInvest
     */
    public function setClient(RestClient $client): TinkoffInvest
    {
        $this->client = $client;

        return $this;
    }
}
