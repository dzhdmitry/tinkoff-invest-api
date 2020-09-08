<?php

namespace Dzhdmitry\TinkoffInvestApi\Schema\Payload;

class Candle
{
    /**
     * @var string
     */
    private string $figi;

    /**
     * @var string
     */
    private string $interval;

    /**
     * @var float
     */
    private float $o;

    /**
     * @var float
     */
    private float $c;

    /**
     * @var float
     */
    private float $h;

    /**
     * @var float
     */
    private float $l;

    /**
     * @var float
     */
    private float $v;

    /**
     * @var \DateTimeInterface
     */
    private \DateTimeInterface $time;

    /**
     * @param string $figi
     * @param string $interval
     * @param float $o
     * @param float $c
     * @param float $h
     * @param float $l
     * @param float $v
     * @param \DateTimeInterface $time
     */
    public function __construct(string $figi, string $interval, float $o, float $c, float $h, float $l, float $v, \DateTimeInterface $time)
    {
        $this->figi = $figi;
        $this->interval = $interval;
        $this->o = $o;
        $this->c = $c;
        $this->h = $h;
        $this->l = $l;
        $this->v = $v;
        $this->time = $time;
    }

    /**
     * @return string
     */
    public function getFigi(): string
    {
        return $this->figi;
    }

    /**
     * @return string
     */
    public function getInterval(): string
    {
        return $this->interval;
    }

    /**
     * @return float
     */
    public function getO(): float
    {
        return $this->o;
    }

    /**
     * @return float
     */
    public function getC(): float
    {
        return $this->c;
    }

    /**
     * @return float
     */
    public function getH(): float
    {
        return $this->h;
    }

    /**
     * @return float
     */
    public function getL(): float
    {
        return $this->l;
    }

    /**
     * @return float
     */
    public function getV(): float
    {
        return $this->v;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getTime(): \DateTimeInterface
    {
        return $this->time;
    }
}
