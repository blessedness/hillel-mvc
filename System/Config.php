<?php

declare(strict_types=1);

namespace System;

class Config
{
    /**
     * @var string|null
     */
    private $path;

    public function __construct(?string $path = null)
    {
        $this->path = $path ?: __DIR__.'/../config';
    }

    public function get(string $name)
    {
        $file = $this->path.DIRECTORY_SEPARATOR.$name . '.php';

        if (!file_exists($file)) {
            throw new \RuntimeException('Config file doesn`t exist: '.$file);
        }

        return require $file;
    }
}
