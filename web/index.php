<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;

$routes = include __DIR__.'/../src/routes.php';
$app = include __DIR__.'/../src/container.php';

$app['listener.string_response'] = function($c) {
    return new Simplex\StringResponseListener;
};
$app['dispatcher']->addSubscriber($app['listener.string_response']);

$request = Request::createFromGlobals();
$response = $app['framework']->handle($request);

$response->send();
