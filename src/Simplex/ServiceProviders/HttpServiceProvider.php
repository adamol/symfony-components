<?php

namespace Simplex\ServiceProviders;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\HttpFoundation;

class HttpServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['request_stack'] = function($c) {
            return new HttpFoundation\RequestStack();
        };
    }
}
