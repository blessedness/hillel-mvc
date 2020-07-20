<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;
use System\Web\Controller;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        return $this->render('index');
    }
}
