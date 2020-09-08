<?php

namespace Dzhdmitry\TinkoffInvestApi\Schema\Payload;

class Error
{
    /**
     * @var string
     */
    private string $message;

    /**
     * @var string
     */
    private string $code;

    /**
     * @param string $message
     * @param string $code
     */
    public function __construct(string $message, string $code)
    {
        $this->message = $message;
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }
}
