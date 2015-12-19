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
        $request->attributes->set('foo', 'bar');
        $response = render_template($request);
        $response->headers->set('Content-Type', 'text/plain');

        return $response;
    }

    public function fooAction()
    {
        $response = new Response('cached response (10 sec): ' . time());
        $response->setTtl(10);
        return $response;
    }
}
