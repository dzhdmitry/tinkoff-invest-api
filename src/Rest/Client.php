<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest;

use Dzhdmitry\TinkoffInvestApi\Rest\Api\Market;
use Dzhdmitry\TinkoffInvestApi\Rest\Api\Operations;
use Dzhdmitry\TinkoffInvestApi\Rest\Api\Orders;
use Dzhdmitry\TinkoffInvestApi\Rest\Api\Portfolio;
use Dzhdmitry\TinkoffInvestApi\Rest\Api\Sandbox;
use Dzhdmitry\TinkoffInvestApi\Rest\Api\User;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class Client
{
    public const REQUEST_DATE_FORMAT = 'Y-m-d\TH:i:s.uP';

    /**
     * @var string
     */
    private string $token;

    /**
     * @var ClientInterface
     */
    private ClientInterface $httpClient;

    /**
     * @var ResponseDeserializer
     */
    private ResponseDeserializer $deserializer;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

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
     * @param string $token
     * @param ClientInterface $client
     * @param ResponseDeserializer $deserializer
     * @param LoggerInterface|null $logger
     */
    public function __construct(string $token, ClientInterface $client, ResponseDeserializer $deserializer, ?LoggerInterface $logger = null)
    {
        $this->token = $token;
        $this->httpClient = $client;
        $this->deserializer = $deserializer;
        $this->logger = ($logger !== null) ? $logger : new NullLogger();
    }

    /**
     * @return Market
     */
    public function market(): Market
    {
        if ($this->market === null) {
            $this->market = new Market($this, $this->deserializer);
        }

        return $this->market;
    }

    /**
     * @return Operations
     */
    public function operations(): Operations
    {
        if ($this->operations === null) {
            $this->operations = new Operations($this, $this->deserializer);
        }

        return $this->operations;
    }

    /**
     * @return Orders
     */
    public function orders(): Orders
    {
        if ($this->orders === null) {
            $this->orders = new Orders($this, $this->deserializer);
        }

        return $this->orders;
    }

    /**
     * @return Portfolio
     */
    public function portfolio(): Portfolio
    {
        if ($this->portfolio === null) {
            $this->portfolio = new Portfolio($this, $this->deserializer);
        }

        return $this->portfolio;
    }

    /**
     * @return Sandbox
     */
    public function sandbox(): Sandbox
    {
        if ($this->sandbox === null) {
            $this->sandbox = new Sandbox($this, $this->deserializer);
        }

        return $this->sandbox;
    }

    /**
     * @return User
     */
    public function user(): User
    {
        if ($this->user === null) {
            $this->user = new User($this, $this->deserializer);
        }

        return $this->user;
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $query
     * @param array $body
     *
     * @return ResponseInterface
     *
     * @throws GuzzleException
     */
    public function request(string $method, string $uri, array $query = [], array $body = []): ResponseInterface
    {
        $options = [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        ];

        if (count($query)) {
            $options['query'] = $query;
        }

        if (count($body)) {
            $options['json'] = $body;
        }

        try {
            $response = $this->httpClient->request($method, $uri, $options);
        } catch (RequestException $e) {
            $this->logger->error($e->getMessage());

            throw $e;
        } catch (GuzzleException $e) {
            $this->logger->critical($e->getMessage());

            throw $e;
        }

        return $response;
    }

    /**
     * @param ClientInterface $httpClient
     *
     * @return Client
     */
    public function setHttpClient(ClientInterface $httpClient): Client
    {
        $this->httpClient = $httpClient;

        return $this;
    }
}
