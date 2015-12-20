<?php

ini_set('display_errors', 1);

require_once __DIR__ . '/../vendor/autoload.php';
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel;
use Simplex;

$request = Request::createFromGlobals();
$routes = require_once __DIR__ . '/../src/routes.php';

$framework = new Simplex\Framework($routes);
$framework = new HttpKernel\HttpCache\HttpCache($framework, new HttpKernel\HttpCache\Store(__DIR__ . '/../cache'));

$response = $framework->handle($request);
$response->send();
