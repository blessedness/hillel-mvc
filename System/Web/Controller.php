<?php

declare(strict_types=1);

namespace System\Web;

use System\BaseController;

class Controller extends BaseController
{
    /**
     * @var Request
     */
    private $request;

    public function __construct()
    {
        $this->renderer = new View();
        $this->request = new Request();
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    public function redirect(string $path)
    {
        header('Location: ' . $path);
        exit;
    }
}
