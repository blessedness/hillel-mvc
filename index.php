<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__.'/vendor/autoload.php';

$response = null;

$request = Request::createFromGlobals();

$path = $request->getPathInfo();

// просто маршрутизатор
switch ($request->getPathInfo()) {
    case 'user':
        $response = (new UserController)->index();
        break;
    case 'user/create':
        $response = (new UserController)->create();
        break;
    default:
        $response = (new IndexController)->index();
}

echo $response;
