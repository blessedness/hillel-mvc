<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;

require_once __DIR__.'/vendor/autoload.php';

$response = null;

$uri = rtrim(ltrim($_SERVER['REQUEST_URI'], '/'), '?');

// просто маршрутизатор
switch ($uri) {
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
