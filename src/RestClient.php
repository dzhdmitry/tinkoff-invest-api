<?php

namespace Dzhdmitry\TinkoffInvestApi;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Symfony\Component\Serializer\SerializerInterface;

class RestClient
{
    public const REQUEST_DATE_FORMAT = 'Y-m-d\TH:i:s.uP';

    private const RESPONSE_FORMAT = 'json';

    /**
     * @var string
     */
    private string $token;

    /**
     * @var ClientInterface
     */
    private ClientInterface $client;

    /**
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param string $token
     * @param ClientInterface $client
     * @param SerializerInterface $serializer
     * @param LoggerInterface|null $logger
     */
    public function __construct(string $token, ClientInterface $client, SerializerInterface $serializer, ?LoggerInterface $logger = null)
    {
        $this->token = $token;
        $this->client = $client;
        $this->serializer = $serializer;
        $this->logger = $logger ? $logger : new NullLogger();
    }

    /**
     * @param string $uri
     * @param string $responseClass
     * @param array $query
     *
     * @return mixed
     *
     * @throws GuzzleException
     */
    public function get(string $uri, string $responseClass, array $query = [])
    {
        $response = $this->request('GET', $uri, $query);

        return $this->serializer->deserialize(
            $response->getBody()->getContents(),
            $responseClass,
            self::RESPONSE_FORMAT
        );
    }

    /**
     * @param string $uri
     * @param string $responseClass
     * @param array $query
     * @param array $body
     *
     * @return mixed
     *
     * @throws GuzzleException
     */
    public function post(string $uri, string $responseClass, array $query = [], array $body = [])
    {
        $response = $this->request('POST', $uri, $query, $body);

        return $this->serializer->deserialize(
            $response->getBody()->getContents(),
            $responseClass,
            self::RESPONSE_FORMAT
        );
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
