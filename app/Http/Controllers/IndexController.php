<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\HomeService;
use Symfony\Component\HttpFoundation\Request;
use System\Web\Controller;

class IndexController extends Controller
{
    /**
     * @var HomeService
     */
    private $homeService;

    /**
     * @var Request
     */
    private $request;

    public function __construct(HomeService $homeService, Request $request)
    {
        $this->homeService = $homeService;
        $this->request = $request;
    }

    public function __invoke()
    {
        return $this->render('index');
    }
}
