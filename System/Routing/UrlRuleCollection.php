<?php

declare(strict_types=1);

namespace System\Routing;

class UrlRuleCollection
{
    /**
     * @var UrlRule[]
     */
    private $rules = [];

    public function any(string $name, string $pattern, $handler, array $tokens = []): void
    {
        $this->rules[] = new UrlRule($name, $pattern, $handler, [], $tokens);
    }

    public function get(string $name, string $pattern, $handler, array $tokens = []): void
    {
        $this->rules[] = new UrlRule($name, $pattern, $handler, ['GET'], $tokens);
    }

    public function post(string $name, string $pattern, $handler, array $tokens = []): void
    {
        $this->rules[] = new UrlRule($name, $pattern, $handler, ['POST'], $tokens);
    }

    /**
     * @return UrlRule[]
     */
    public function getRules(): array
    {
        return $this->rules;
    }
}
