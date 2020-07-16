<?php

declare(strict_types=1);

namespace System\Routing;

use Symfony\Component\HttpFoundation\Request;
use System\Routing\Exceptions\RequestNotMatchedException;
use System\Routing\Exceptions\RouteNotFoundException;

class UrlManager
{
    /**
     * @var UrlRuleCollection
     */
    private $rules;

    public function __construct(UrlRuleCollection $rules)
    {
        $this->rules = $rules;
    }

    public function match(Request $request): UrlResult
    {
        foreach ($this->rules->getRules() as $rule) {
            if (!empty($rule->methods) && !in_array($request->getMethod(), $rule->methods, true)) {
                continue;
            }

            $pattern = preg_replace_callback('~\{([^\}]+)\}~', function ($matches) use ($rule) {
                $argument = $matches[1];
                $replaced = $rule->tokens[$argument] ?? '[^\}]+';
                return '(?P<'.$argument.'>'.$replaced.')';
            }, $rule->pattern);

            if (preg_match('~^'.$pattern.'$~i', $request->getPathInfo(), $matches)) {
                return new UrlResult($rule->name, $rule->handler, array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY));
            }
        }

        throw new RequestNotMatchedException($request);
    }

    public function generate(string $name, array $params = [])
    {
        $attributes = array_filter($params);

        foreach ($this->rules->getRules() as $rule) {
            if ($rule->name !== $name) {
                continue;
            }

            $url = preg_replace_callback('~\{([^\}]+)\}~', function ($matches) use ($attributes) {
                $argument = $matches[1];

                $value = $attributes[$argument] ?? null;
                if (!$value) {
                    throw new \InvalidArgumentException('Argument not exist: '.$argument);
                }

                return $value;
            }, $rule->pattern);

            if (!is_null($url)) {
                return $url;
            }
        }

        throw new RouteNotFoundException($name, $attributes);
    }
}
