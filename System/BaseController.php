<?php

declare(strict_types=1);

namespace System;

use System\Container\ContainerInterface;
use System\Contracts\Render;

abstract class BaseController
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }

    /**
     * Метод для рендеринга файла шаблона
     *
     * @param  string  $view  название файла вида
     * @param  array  $params  параметры для вида
     * @return false|string
     */
    protected function render(string $view, array $params = [])
    {
        return $this->getContainer()->get(Render::class)->renderView($view, $params);
    }
}
