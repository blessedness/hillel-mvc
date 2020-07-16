<?php

declare(strict_types=1);

namespace System\Routing;

class UrlRule
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $pattern;
    /**
     * @var string|\Closure
     */
    public $handler;
    /**
     * @var array
     */
    public $methods;
    /**
     * @var array
     */
    public $tokens;

    public function __construct(string $name, string $pattern, $handler, array $methods, array $tokens = [])
    {
        $this->name = $name;
        $this->pattern = $pattern;
        $this->handler = $handler;
        $this->methods = $methods;
        $this->tokens = $tokens;
    }
}
