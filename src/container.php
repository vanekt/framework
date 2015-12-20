<?php

use Symfony\Component\DependencyInjection;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpFoundation\RequestStack;

$sc = new DependencyInjection\ContainerBuilder();
$sc->register('context', Symfony\Component\Routing\RequestContext::class);
$sc->register('matcher', Symfony\Component\Routing\Matcher\UrlMatcher::class)
    ->setArguments(array('%routes%', new Reference('context')))
;
$sc->register('resolver', Symfony\Component\HttpKernel\Controller\ControllerResolver::class);
$sc->register('listener.router', Symfony\Component\HttpKernel\EventListener\RouterListener::class)
    ->setArguments(array(new Reference('matcher'), new RequestStack()))
;
$sc->register('listener.response', Symfony\Component\HttpKernel\EventListener\ResponseListener::class)
    ->setArguments(array('UTF-8'))
;
$sc->register('listener.exception', Symfony\Component\HttpKernel\EventListener\ExceptionListener::class)
    ->setArguments(array('App\\Controller\\ErrorController::exceptionAction'))
;
$sc->register('dispatcher', Symfony\Component\EventDispatcher\EventDispatcher::class)
    ->addMethodCall('addSubscriber', array(new Reference('listener.router')))
    ->addMethodCall('addSubscriber', array(new Reference('listener.response')))
    ->addMethodCall('addSubscriber', array(new Reference('listener.exception')))
;
$sc->register('framework', Simplex\Framework::class)
    ->setArguments(array(new Reference('dispatcher'), new Reference('resolver')))
;

return $sc;