<?php

namespace Simplex\ServiceProviders;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\Routing;

class RouteServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['context'] = function($c) {
            return new Routing\RequestContext();
        };
        $routes = include __DIR__.'/../../routes.php';
        $app['matcher'] = function($c) use ($routes) {
            return new Routing\Matcher\UrlMatcher($routes, $c['context']);
        };
    }
}
