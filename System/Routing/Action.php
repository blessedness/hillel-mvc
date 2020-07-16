<?php

declare(strict_types=1);

namespace System\Routing;

use Symfony\Component\HttpFoundation\Request;

class Action
{
    /**
     * @param  string|\Closure  $handler
     */
    public function resolve($handler): callable
    {
        if (is_callable($handler)) {
            return $handler;
        }

        if (!is_string($handler)) {
            throw new \InvalidArgumentException('Invalid handler received.');
        }

        $data = explode('@', $handler);

        $controller = $data[0];
        $action = $data[1] ?? null;

        return function (Request $request) use ($controller, $action) {
            return $action ? (new $controller)->$action($request) : (new $controller)($request);
        };
    }
}
