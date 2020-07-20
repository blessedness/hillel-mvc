<?php

declare(strict_types=1);

namespace System\Routing;

use System\Container\ContainerInterface;
use System\Web\Controller;

class Action
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param  string|\Closure  $handler
     */
    public function resolve($handler): callable
    {
        if (!is_string($handler)) {
            throw new \InvalidArgumentException('Invalid handler received.');
        }

        $data = explode('@', $handler);

        /** @var Controller $controller */
        $controller = $this->container->get($data[0]);
        $controller->setContainer($this->container);

        $action = $data[1] ?? null;

        return function () use ($controller, $action) {
            $method = $action ? $action : '__invoke';

            $params = $this->container->methodParams(get_class($controller), $method);

            return $action ? $controller->$action(...$params) : ($controller)(...$params);
        };
    }
}
