<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use System\Web\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return $this->render('index');
    }
}
