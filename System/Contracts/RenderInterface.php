<?php

declare(strict_types=1);

namespace System\Contracts;

interface RenderInterface
{
    /**
     * Рендеринг файла шаблона
     *
     * @param  string  $view  файл шаблона
     * @param  array  $params  string параметры
     * @return mixed
     */
    public function renderView(string $view, array $params);
}
