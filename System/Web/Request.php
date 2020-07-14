<?php

declare(strict_types=1);

namespace System\Web;

class Request
{
    /**
     * Метод запроса
     *
     * @var string
     */
    private $method;

    public function __construct()
    {
        $this->method = strtoupper($_SERVER['REQUEST_METHOD']);
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }
}
