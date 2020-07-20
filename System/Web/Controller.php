<?php

declare(strict_types=1);

namespace System\Web;

use Symfony\Component\HttpFoundation\Response;
use System\BaseController;

class Controller extends BaseController
{
    protected function render(string $view, array $params = [], int $status = Response::HTTP_OK)
    {
        return new Response(
            parent::render($view, $params),
            $status
        );
    }

    public function redirect(string $path)
    {
        header('Location: ' . $path);
        exit;
    }
}
