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
        return render_template($request);
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
}
