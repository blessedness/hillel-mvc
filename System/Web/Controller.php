<?php

declare(strict_types=1);

namespace System\Web;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use System\BaseController;

class Controller extends BaseController
{
    public function render(string $view, array $params = []): Response
    {
        return new Response(
            parent::render($view, $params)
        );
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->getContainer()->get(Request::class);
    }

    public function redirect(string $path)
    {
        header('Location: '.$path);
        exit;
    }
}
