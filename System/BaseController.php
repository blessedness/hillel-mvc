<?php

declare(strict_types=1);

namespace System;

use System\Contracts\Render;
use System\Web\Request;

abstract class BaseController
{
    /**
     * @var Render
     */
    protected $renderer;

    /**
     * Метод для рендеринга файла шаблона
     *
     * @param  string  $view  название файла вида
     * @param  array  $params  параметры для вида
     * @return false|string
     */
    protected function render(string $view, array $params = [])
    {
        return $this->renderer->renderView($view, $params);
    }
}
