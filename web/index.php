<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;

$dispatcher = new EventDispatcher();
$dispatcher->addSubscriber('response', [new \Simplex\ContentLengthListener(), 'onResponse']);
$dispatcher->addSubscriber('response', [new \Simple\GoogleListener(), 'onResponse']);

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../src/routes.php';

$context = new Routing\RequestContext();
$matcher = new Routing\Matcher\UrlMatcherInterface($routes, $context);

$controllerResolver = new HttpKernel\Controller\ControllerResolver();
$argumentResolver = new HttpKernel\Controller\ArgumentResolver();

$framework = new Simplex\Framework($matcher, $controllerResolver, $argumentResolver);
$response = $framework->handle($request);

$response->send();
