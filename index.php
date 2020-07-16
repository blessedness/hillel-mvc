<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use Symfony\Component\HttpFoundation\Request;
use System\Routing\Action;
use System\Routing\UrlManager;
use System\Routing\UrlRuleCollection;

require_once __DIR__.'/vendor/autoload.php';

$response = null;

$rules = new UrlRuleCollection();
$rules->get('home', '/', IndexController::class);
$rules->get('users', '/user', 'App\Http\Controllers\UserController@index');

$rules->get('user-create', '/user/create', 'App\Http\Controllers\UserController@create');

$rules->get('user-view', '/user/{id}', function (Request $request) {
    $id = $request->attributes->get('id');
    return (new UserController)->view($id, $request);
}, ['id' => '\d+']);

$urlManager = new UrlManager($rules);

$request = Request::createFromGlobals();


try {
    $result = $urlManager->match($request);
    $request->attributes->add($result->getAttributes());

    $action = (new Action())->resolve(
        $result->getHandler()
    );

    $response = $action($request);
} catch (Throwable $exception) {
    dd($exception);
}

echo $response;
exit();
