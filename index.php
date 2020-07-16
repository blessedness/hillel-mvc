<?php

use App\Http\Controllers\UserController;
use Symfony\Component\HttpFoundation\Request;
use System\Routing\UrlManager;
use System\Routing\UrlRuleCollection;

require_once __DIR__.'/vendor/autoload.php';

$response = null;

$rules = new UrlRuleCollection();
$rules->get('users', '/user', function (Request $request) {
    return (new UserController)->index();
});
$rules->get('user-view', '/user/{id}', function (Request $request) {
    $id = $request->attributes->get('id');
    return (new UserController)->view($id, $request);
}, ['id' => '\d+']);

$urlManager = new UrlManager($rules);

$request = Request::createFromGlobals();

$urlManager->generate('user-view', ['id' => 1]);

$result = $urlManager->match($request);
$request->attributes->add($result->getAttributes());

$action = $result->getHandler();
if (is_string($action)) {

} elseif (is_callable($action)) {
    $response = $action($request);
}

echo $response;
