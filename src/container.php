<?php

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;
use Pimple\Container;

$app = new Container;

$serviceProviders = [
    'Simplex\ServiceProviders\EventServiceProvider',
    'Simplex\ServiceProviders\FrameworkServiceProvider',
    'Simplex\ServiceProviders\RouteServiceProvider',
    'Simplex\ServiceProviders\HttpServiceProvider',
    'Simplex\ServiceProviders\KernelServiceProvider'
];

foreach ($serviceProviders as $provider) {
    $app->register(new $provider);
}

return $app;

