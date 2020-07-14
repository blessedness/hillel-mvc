<?php

declare(strict_types=1);

namespace System\Web;

use System\Contracts\Render;

class View implements Render
{
    public $layout = 'layouts/main';

    public $title;

    public function renderView(string $view, array $params = [])
    {
        $html = $this->renderFile($view, $params);

        return $this->renderLayout([
            'content' => $html,
            'title' => $this->title,
        ]);
    }

    public function renderFile(string $view, array $params = [])
    {
        $file = __DIR__.'/../../views/'.$view.'.php';

        if (!file_exists($file)) {
            throw new \RuntimeException('View file not found: '.$view);
        }

        // запускаем буферизацию вывода
        ob_start();

        // импортируем переменные из массива в файл вида
        extract($params, EXTR_OVERWRITE);

        // подключаем файл вида
        require $file;

        // получаем содержимое текущего буфера и удаляем его
        return ob_get_clean();
    }

    public function renderLayout(array $params = [])
    {
        return $this->renderFile($this->layout, $params);
    }
}
