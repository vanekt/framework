<?php

use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();

$routes->add('index', new Routing\Route('/', array(
    '_controller' => 'App\\Controller\\HelloController::indexAction',
)));

$routes->add('hello', new Routing\Route('hello/{name}', array(
    '_controller' => 'App\\Controller\\HelloController::helloAction',
    'name' => 'World',
)));

$routes->add('bye', new Routing\Route('bye', array(
    '_controller' => 'App\\Controller\\HelloController::byeAction',
)));

$routes->add('foo', new Routing\Route('foo', array(
    '_controller' => 'App\\Controller\\HelloController::fooAction',
)));

return $routes;