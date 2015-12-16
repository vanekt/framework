<?php

use Symfony\Component\Routing;

class HelloController
{
    public function indexAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        return render_template($request);
    }

    public function byeAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        // $foo will be available in the template
        $request->attributes->set('foo', 'bar');

        $response = render_template($request);

        // change some header
        $response->headers->set('Content-Type', 'text/plain');

        return $response;
    }

    public function fooAction()
    {
        return new \Symfony\Component\HttpFoundation\Response('foo');
    }
}

$routes = new Routing\RouteCollection();

$routes->add('hello', new Routing\Route('hello/{name}', array(
    '_controller' => 'HelloController::indexAction',
)));

$routes->add('bye', new Routing\Route('bye', array(
    '_controller' => 'HelloController::byeAction',
)));

$routes->add('foo', new Routing\Route('foo', array(
    '_controller' => 'HelloController::fooAction',
)));

return $routes;