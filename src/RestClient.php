<?php

namespace Dzhdmitry\TinkoffInvestApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class RestClient
{
    public const REQUEST_DATE_FORMAT = 'Y-m-d\TH:i:s.uP';

    /**
     * @var string
     */
    private string $token;

    /**
     * @var Client
     */
    private Client $client;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param string $token
     * @param Client $client
     * @param LoggerInterface|null $logger
     */
    public function __construct(string $token, Client $client, ?LoggerInterface $logger = null)
    {
        $this->token = $token;
        $this->client = $client;
        $this->logger = $logger ? $logger : new NullLogger();
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
        try {
            $response = $this->client->request($method, $uri, $this->buildOptions($query, $body));
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
     * @param array $query
     * @param array $body
     *
     * @return array
     */
    private function buildOptions(array $query, array $body): array
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

        return $options;
    }
}
