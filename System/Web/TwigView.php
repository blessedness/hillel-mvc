<?php

declare(strict_types=1);

namespace System\Web;

use System\Contracts\RenderInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigView implements RenderInterface
{
    public function renderView(string $view, array $params)
    {
        $loader = new FilesystemLoader([
            __DIR__.'/../../views',
        ]);

        $twig = new Environment($loader);

        return $twig->render($view.'.html.twig', $params);
    }
}
