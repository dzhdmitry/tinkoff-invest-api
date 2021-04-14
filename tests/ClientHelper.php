<?php

namespace Dzhdmitry\TinkoffInvestApi\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class ClientHelper
{
    /**
     * @param array $payload
     *
     * @return ClientInterface
     */
    public static function createClient(array $payload): ClientInterface
    {
        $response = [
            'trackingId' => '7ca3b36e983b0f6c',
            'status' => 'Ok',
            'payload' => $payload,
        ];

        $mock = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        return new Client([
            'handler' => HandlerStack::create($mock),
        ]);
    }
}
