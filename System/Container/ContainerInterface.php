<?php

declare(strict_types=1);

namespace System\Container;

interface ContainerInterface
{
    public function get(string $id);

    public function set(string $id, $value);

    public function has(string $id);
}
