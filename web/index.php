<?php

//ini_set('display_errors', 1);

require_once __DIR__ . '/../vendor/autoload.php';
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;

$request = Request::createFromGlobals();

$routes = require_once __DIR__ . '/../src/routes.php';

$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);
$urlGenerator = new Routing\Generator\UrlGenerator($routes, $context);

try {
    ob_start();
    extract($matcher->match($request->getPathInfo()), EXTR_SKIP);
    require sprintf(__DIR__ . '/../src/pages/%s.php', $_route);
    $response = new Response(ob_get_clean());
} catch (Routing\Exception\ResourceNotFoundException $e) {
    $response = new Response('Not Found', 404);
} catch (Exception $e) {
    $response = new Response('An error occurred', 500);
}

$response->send();