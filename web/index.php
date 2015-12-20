<?php

ini_set('display_errors', 1);

require_once __DIR__ . '/../vendor/autoload.php';
 
use Simplex;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel;
use Symfony\Component\DependencyInjection\Reference;

$request = Request::createFromGlobals();

$sc = include __DIR__ . '/../src/container.php';
$sc->setParameter('routes', include __DIR__ . '/../src/routes.php');
$sc->register('listener.string_response', Simplex\StringResponseListener::class);
$sc->getDefinition('dispatcher')
    ->addMethodCall('addSubscriber', array(new Reference('listener.string_response')))
;

$framework = $sc->get('framework');
$framework = new HttpKernel\HttpCache\HttpCache($framework, new HttpKernel\HttpCache\Store(__DIR__ . '/../cache'));

$response = $framework->handle($request);
$response->send();
