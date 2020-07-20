<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use Symfony\Component\HttpFoundation\Request;
use System\Routing\UrlRuleCollection;
use System\Web\Application;

require_once __DIR__.'/vendor/autoload.php';

$response = null;

$rules = new UrlRuleCollection();
$rules->get('home', '/', IndexController::class);
$rules->get('users', '/user', 'App\Http\Controllers\UserController@index');

$rules->get('user-create', '/user/create', 'App\Http\Controllers\UserController@create');
$rules->post('user-create', '/user/create', 'App\Http\Controllers\UserController@create');

$rules->get('user-view', '/user/{id}', function (Request $request) {
    $id = $request->attributes->get('id');
    return (new UserController)->view($id, $request);
}, ['id' => '\d+']);

$config = [
    'rules' => $rules,
];

$response = (new Application($config))->run();
