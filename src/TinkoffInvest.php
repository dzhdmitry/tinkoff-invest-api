<?php

namespace Dzhdmitry\TinkoffInvestApi;

use Dzhdmitry\TinkoffInvestApi\Api\Market;
use Dzhdmitry\TinkoffInvestApi\Api\Operations;
use Dzhdmitry\TinkoffInvestApi\Api\Orders;
use Dzhdmitry\TinkoffInvestApi\Api\Portfolio;
use Dzhdmitry\TinkoffInvestApi\Api\Sandbox;
use Dzhdmitry\TinkoffInvestApi\Api\User;
use Dzhdmitry\TinkoffInvestApi\Schema\Payload as Types;
use Dzhdmitry\TinkoffInvestApi\Schema\OrdersResponse;
use GuzzleHttp\Client;

class TinkoffInvest
{
    private const BASE_URI = 'https://api-invest.tinkoff.ru';

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
     * @param string $token
     *
     * @return TinkoffInvest
     */
    public static function create(string $token): TinkoffInvest
    {
        $client = new RestClient(
            $token,
            new Client([
                'base_uri' => self::BASE_URI,
            ])
        );
        $deserializer = ResponseDeserializer::create([
            Types\Candles::class => [
                'candles' => Types\Candle::class,
            ],
            Types\Currencies::class => [
                'currencies' => Types\CurrencyPosition::class,
            ],
            Types\MarketInstrumentList::class => [
                'instruments' => Types\MarketInstrument::class,
            ],
            Types\Operation::class => [
                'trades' => Types\OperationTrade::class,
            ],
            Types\Operations::class => [
                'operations' => Types\Operation::class,
            ],
            Types\Orderbook::class => [
                'bids' => Types\OrderResponse::class,
                'asks' => Types\OrderResponse::class,
            ],
            OrdersResponse::class => [
                'payload' => Types\Order::class,
            ],
            Types\Portfolio::class => [
                'positions' => Types\PortfolioPosition::class,
            ],
            Types\UserAccounts::class => [
                'accounts' => Types\Account::class,
            ],
        ]);

        return new self($client, $deserializer);
    }

    /**
     * @return Market
     */
    public function market(): Market
    {
        return new Market(new RestClientFacade($this->client, $this->deserializer));
    }

    /**
     * @param string|null $brokerAccountId
     *
     * @return Operations
     */
    public function operations(?string $brokerAccountId = null): Operations
    {
        return new Operations(new RestClientFacade($this->client, $this->deserializer, $brokerAccountId));
    }

    /**
     * @param string|null $brokerAccountId
     *
     * @return Orders
     */
    public function orders(?string $brokerAccountId = null): Orders
    {
        return new Orders(new RestClientFacade($this->client, $this->deserializer, $brokerAccountId));
    }

    /**
     * @param string|null $brokerAccountId
     *
     * @return Portfolio
     */
    public function portfolio(?string $brokerAccountId = null): Portfolio
    {
        return new Portfolio(new RestClientFacade($this->client, $this->deserializer, $brokerAccountId));
    }

    /**
     * @param string|null $brokerAccountId
     *
     * @return Sandbox
     */
    public function sandbox(?string $brokerAccountId = null): Sandbox
    {
        return new Sandbox(new RestClientFacade($this->client, $this->deserializer, $brokerAccountId));
    }

    /**
     * @return User
     */
    public function user(): User
    {
        return new User(new RestClientFacade($this->client, $this->deserializer));
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
