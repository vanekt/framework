<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HelloController
{
    public function indexAction()
    {
        return new Response('index');
    }

    public function helloAction(Request $request)
    {
        return $this->renderTemplate($request);
    }

    public function byeAction(Request $request)
    {
        return 'bye';
    }

    public function fooAction()
    {
        $response = new Response('cached response (10 sec): ' . time());
        $response->setTtl(10);
        return $response;
    }

    public function renderTemplate(Request $request)
    {
        extract($request->attributes->all(), EXTR_SKIP);
        ob_start();
        require sprintf(__DIR__ . '/../../../src/pages/%s.php', $_route);

        return new Response(ob_get_clean());
    }
}
