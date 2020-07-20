<?php

declare(strict_types=1);

namespace System\Web;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use System\BaseApplication;
use System\Container\ContainerInterface;
use System\Contracts\RenderInterface;
use System\Routing\Action;
use System\Routing\UrlManager;
use System\Routing\UrlRuleCollection;

class Application extends BaseApplication
{
    public function run()
    {
        /** @var UrlRuleCollection $rules */
        $rules = $this->getContainer()->get('rules');

        $urlManager = new UrlManager($rules);

        $components = $this->getContainer()->get('components');

        $this->getContainer()->set(ContainerInterface::class, $this->getContainer());
        $this->getContainer()->set(Request::class, Request::createFromGlobals());
        $this->getContainer()->set('request', $this->getContainer()->get(Request::class));
        $this->getContainer()->set(UrlManager::class, $urlManager);

        foreach ($components as $key => $component) {
            $this->getContainer()->set($key, $component['class']);
        }

        try {
            $request = $this->getContainer()->get(Request::class);

            $result = $urlManager->match($request);
            $request->attributes->add($result->getAttributes());

            $action = (new Action($this->getContainer()))->resolve(
                $result->getHandler()
            );

            /** @var Response $response */
            $response = $action($request);
        } catch (\Throwable $exception) {
            dd($exception);
        }

        $response->send();
        exit();
    }
}
