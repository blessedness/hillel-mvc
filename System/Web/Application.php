<?php

declare(strict_types=1);

namespace System\Web;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use System\Contracts\Render;
use System\Routing\Action;
use System\Routing\UrlManager;
use System\Routing\UrlRuleCollection;

class Application extends \System\Application
{
    public function run()
    {
        /** @var UrlRuleCollection $rules */
        $rules = $this->getContainer()->get('rules');

        $urlManager = new UrlManager($rules);

        $request = Request::createFromGlobals();

        $this->getContainer()->set(Request::class, $request);
        $this->getContainer()->set(Render::class, View::class);

        try {
            $result = $urlManager->match($request);
            $request->attributes->add($result->getAttributes());

            $action = (new Action($this->getContainer()))->resolve(
                $result->getHandler()
            );

            /** @var Response $response */
            $response = $action($request);

            $response->send();
        } catch (\Throwable $exception) {
            dd($exception);
        }

        exit();
    }
}
