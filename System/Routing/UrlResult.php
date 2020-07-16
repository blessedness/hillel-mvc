<?php

declare(strict_types=1);

namespace System\Routing;

class UrlResult
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string|\Closure
     */
    private $handler;
    /**
     * @var array
     */
    private $attributes;

    public function __construct(string $name, $handler, array $attributes = [])
    {
        $this->name = $name;
        $this->handler = $handler;
        $this->attributes = $attributes;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @return \Closure|string
     */
    public function getHandler()
    {
        return $this->handler;
    }
}
