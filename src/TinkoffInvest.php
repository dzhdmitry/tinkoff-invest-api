<?php

namespace Dzhdmitry\TinkoffInvestApi;

use Dzhdmitry\TinkoffInvestApi\Api\Market;
use Dzhdmitry\TinkoffInvestApi\Api\Operations;
use Dzhdmitry\TinkoffInvestApi\Api\Orders;
use Dzhdmitry\TinkoffInvestApi\Api\Portfolio;
use Dzhdmitry\TinkoffInvestApi\Api\Sandbox;
use Dzhdmitry\TinkoffInvestApi\Api\User;
use GuzzleHttp\Client;

class TinkoffInvest
{
    private const BASE_URI = 'https://api-invest.tinkoff.ru';

    /**
     * @var RestClient
     */
    private RestClient $client;

    /**
     * @var Market|null
     */
    private ?Market $market = null;

    /**
     * @var Operations|null
     */
    private ?Operations $operations = null;

    /**
     * @var Orders|null
     */
    private ?Orders $orders = null;

    /**
     * @var Portfolio|null
     */
    private ?Portfolio $portfolio = null;

    /**
     * @var Sandbox|null
     */
    private ?Sandbox $sandbox = null;

    /**
     * @var User|null
     */
    private ?User $user = null;

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
        if ($this->market === null) {
            $this->market = new Market($this->client);
        }

        return $this->market;
    }

    /**
     * @return Operations
     */
    public function operations(): Operations
    {
        if ($this->operations === null) {
            $this->operations = new Operations($this->client);
        }

        return $this->operations;
    }

    /**
     * @return Orders
     */
    public function orders(): Orders
    {
        if ($this->orders === null) {
            $this->orders = new Orders($this->client);
        }

        return $this->orders;
    }

    /**
     * @return Portfolio
     */
    public function portfolio(): Portfolio
    {
        if ($this->portfolio === null) {
            $this->portfolio = new Portfolio($this->client);
        }

        return $this->portfolio;
    }

    /**
     * @return Sandbox
     */
    public function sandbox(): Sandbox
    {
        if ($this->sandbox === null) {
            $this->sandbox = new Sandbox($this->client);
        }

        return $this->sandbox;
    }

    /**
     * @return User
     */
    public function user(): User
    {
        if ($this->user === null) {
            $this->user = new User($this->client);
        }

        return $this->user;
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
