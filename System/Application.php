<?php

declare(strict_types=1);

namespace System;

use System\Container\Container;

abstract class Application
{
    /**
     * @var Container
     */
    private $container;

    public function __construct(array $config = [])
    {
        $this->container = new Container($config);
    }

    public abstract function run();

    /**
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }
}
