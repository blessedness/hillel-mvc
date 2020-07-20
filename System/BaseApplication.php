<?php

declare(strict_types=1);

namespace System;

use System\Container\Container;
use System\Container\ContainerInterface;

abstract class BaseApplication
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(array $config = [])
    {
        $this->container = new Container($config);
    }

    abstract public function run();

    /**
     * @return ContainerInterface
     */
    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }
}
