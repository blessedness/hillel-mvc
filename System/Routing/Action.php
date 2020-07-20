<?php

declare(strict_types=1);

namespace System\Routing;

use System\BaseController;
use System\Container\ContainerInterface;

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
        if (is_callable($handler)) {
            return $handler;
        }

        if (!is_string($handler)) {
            throw new \InvalidArgumentException('Invalid handler received.');
        }

        $data = explode('@', $handler);

        /** @var BaseController $controller */
        $controller = $this->container->get($data[0]);
        $controller->setContainer($this->container);

        $action = $data[1] ?? null;

        return function () use ($controller, $action) {
            return $action ? $controller->$action() : ($controller)();
        };
    }
}
