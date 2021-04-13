<?php

namespace Dzhdmitry\TinkoffInvestApi\Streaming;

use Amp\Http\Client\HttpException;
use Amp\Promise;
use Amp\Websocket\Client\ConnectionException;
use Amp\Websocket\Client\Handshake;
use function Amp\Websocket\Client\connect;

class WebsocketConnectionFactory
{
    private const URL = 'wss://api-invest.tinkoff.ru/openapi/md/v1/md-openapi/ws';

    /**
     * @param string $token
     *
     * @return Promise
     *
     * @throws HttpException
     * @throws ConnectionException
     */
    public static function create(string $token): Promise
    {
        return connect(new Handshake(self::URL, null, [
            'Authorization' => 'Bearer ' . $token,
        ]));
    }
}
