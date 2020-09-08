<?php

namespace Dzhdmitry\TinkoffInvestApi\Tests;

use Dzhdmitry\TinkoffInvestApi\RestClient;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\MockObject\MockObject;

class ClientHelper
{
    /**
     * @param string $token
     * @param array $payload
     *
     * @return MockObject|RestClient
     */
    public static function createClient(string $token, array $payload): RestClient
    {
        $response = [
            'trackingId' => '7ca3b36e983b0f6c',
            'status' => 'Ok',
            'payload' => $payload,
        ];

        $mock = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);
        $handlerStack = HandlerStack::create($mock);

        return new RestClient($token, new Client(['handler' => $handlerStack]));
    }
}
