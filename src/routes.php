<?php

use Symfony\Component\Routing;

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