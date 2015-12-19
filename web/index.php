<?php

ini_set('display_errors', 1);

require_once __DIR__ . '/../vendor/autoload.php';
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;
use Symfony\Component\HttpKernel\HttpCache\HttpCache;
use Symfony\Component\HttpKernel\HttpCache\Store;
use Simplex;

$request = Request::createFromGlobals();
$routes = require_once __DIR__ . '/../src/routes.php';

$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);
$resolver = new HttpKernel\Controller\ControllerResolver();

$dispatcher = new EventDispatcher();
$dispatcher->addSubscriber(new Simplex\GoogleListener());

$framework = new Simplex\Framework($matcher, $resolver, $dispatcher);
$framework = new HttpCache($framework, new Store(__DIR__ . '/../cache'));

$response = $framework->handle($request);
$response->send();

function render_template(Request $request)
{
    extract($request->attributes->all(), EXTR_SKIP);
    ob_start();
    require sprintf(__DIR__ . '/../src/pages/%s.php', $_route);

    return new Response(ob_get_clean());
}