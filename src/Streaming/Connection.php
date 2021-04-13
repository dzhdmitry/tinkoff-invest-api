<?php

namespace Dzhdmitry\TinkoffInvestApi\Streaming;

use Amp\ByteStream\InputStream;
use Amp\Http\Client\Response;
use Amp\Promise;
use Amp\Socket\SocketAddress;
use Amp\Socket\TlsInfo;
use Amp\Websocket\Client\Connection as ConnectionInterface;
use Amp\Websocket\ClientMetadata;
use Amp\Websocket\ClosedException;
use Amp\Websocket\Code;
use Amp\Websocket\Options;
use Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Request\RequestInterface;

class Connection implements ConnectionInterface
{
    /**
     * @var ConnectionInterface
     */
    private ConnectionInterface $connection;

    /**
     * @param ConnectionInterface $connection
     */
    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param RequestInterface $request
     *
     * @return Promise
     *
     * @throws ClosedException
     */
    public function subscribe(RequestInterface $request): Promise
    {
        return $this->send(json_encode($request->subscribe()));
    }

    /**
     * @param RequestInterface $request
     *
     * @return Promise
     *
     * @throws ClosedException
     */
    public function unsubscribe(RequestInterface $request): Promise
    {
        return $this->send(json_encode($request->unsubscribe()));
    }

    /**
     * @return Promise
     *
     * @throws ClosedException
     */
    public function receive(): Promise
    {
        return $this->connection->receive();
    }

    /**
     * @param int $code
     * @param string $reason
     *
     * @return Promise
     */
    public function close(int $code = Code::NORMAL_CLOSE, string $reason = ''): Promise
    {
        return $this->connection->close($code, $reason);
    }

    /**
     * @inheritDoc
     */
    public function getId(): int
    {
        return $this->connection->getId();
    }

    /**
     * @inheritDoc
     */
    public function isConnected(): bool
    {
        return $this->connection->isConnected();
    }

    /**
     * @inheritDoc
     */
    public function getLocalAddress(): SocketAddress
    {
        return $this->connection->getLocalAddress();
    }

    /**
     * @inheritDoc
     */
    public function getRemoteAddress(): SocketAddress
    {
        return $this->connection->getRemoteAddress();
    }

    /**
     * @inheritDoc
     */
    public function getTlsInfo(): ?TlsInfo
    {
        return $this->connection->getTlsInfo();
    }

    /**
     * @inheritDoc
     */
    public function getUnansweredPingCount(): int
    {
        return $this->connection->getUnansweredPingCount();
    }

    /**
     * @inheritDoc
     */
    public function getCloseCode(): int
    {
        return $this->connection->getCloseCode();
    }

    /**
     * @inheritDoc
     */
    public function getCloseReason(): string
    {
        return $this->connection->getCloseReason();
    }

    /**
     * @inheritDoc
     */
    public function isClosedByPeer(): bool
    {
        return $this->connection->isClosedByPeer();
    }

    /**
     * @inheritDoc
     */
    public function send(string $data): Promise
    {
        return $this->connection->send($data);
    }

    /**
     * @inheritDoc
     */
    public function sendBinary(string $data): Promise
    {
        return $this->connection->sendBinary($data);
    }

    /**
     * @inheritDoc
     */
    public function stream(InputStream $stream): Promise
    {
        return $this->connection->stream($stream);
    }

    /**
     * @inheritDoc
     */
    public function streamBinary(InputStream $stream): Promise
    {
        return $this->connection->streamBinary($stream);
    }

    /**
     * @inheritDoc
     */
    public function ping(): Promise
    {
        return $this->connection->ping();
    }

    /**
     * @inheritDoc
     */
    public function getOptions(): Options
    {
        return $this->connection->getOptions();
    }

    /**
     * @inheritDoc
     */
    public function getInfo(): ClientMetadata
    {
        return $this->connection->getInfo();
    }

    /**
     * @inheritDoc
     */
    public function onClose(callable $callback): void
    {
        $this->connection->onClose($callback);
    }

    /**
     * @inheritDoc
     */
    public function getResponse(): Response
    {
        return $this->connection->getResponse();
    }
}
