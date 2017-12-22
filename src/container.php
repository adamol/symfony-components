<?php

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;
use Pimple\Container;

$app = new Container;

$app['context'] = function($c) {
    return new Routing\RequestContext();
};
$app['matcher'] = function($c) use ($routes) {
    return new Routing\Matcher\UrlMatcher($routes, $c['context']);
};
$app['request_stack'] = function($c) {
    return new HttpFoundation\RequestStack();
};
$app['controller_resolver'] = function($c) {
    return new HttpKernel\Controller\ControllerResolver();
};
$app['argument_resolver'] = function($c) {
    return new HttpKernel\Controller\ArgumentResolver();
};

$app['listener.router'] = function($c) {
    return new HttpKernel\EventListener\RouterListener($c['matcher'], $c['request_stack']);
};
$app['listener.response'] = function($c) {
    return new HttpKernel\EventListener\ResponseListener('UTF-8');
};
$app['listener.exception'] = function($c) {
    return new HttpKernel\EventListener\ExceptionListener([
        'Calendar\Controller\ErrorController:exceptionAction'
    ]);
};
$app['dispatcher'] = function($c) {
    $dispatcher = new EventDispatcher();
    $dispatcher->addSubscriber($c['listener.router']);
    $dispatcher->addSubscriber($c['listener.response']);
    return $dispatcher;
};

$app['framework'] = function($c) {
    return new Simplex\Framework(
        $c['dispatcher'],
        $c['controller_resolver'],
        $c['request_stack'],
        $c['argument_resolver']
    );
};

return $app;

