<?php

namespace Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Response;

abstract class AbstractResponse
{
    /**
     * @var string
     */
    private string $event;

    /**
     * @var \DateTimeInterface
     */
    private \DateTimeInterface $time;

    /**
     * @param string $event
     * @param \DateTimeInterface $time
     */
    public function __construct(string $event, \DateTimeInterface $time)
    {
        $this->event = $event;
        $this->time = $time;
    }

    /**
     * @return string
     */
    public function getEvent(): string
    {
        return $this->event;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getTime(): \DateTimeInterface
    {
        return $this->time;
    }
}
