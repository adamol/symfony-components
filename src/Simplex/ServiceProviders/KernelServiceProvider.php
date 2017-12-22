<?php

namespace Simplex\ServiceProviders;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\HttpKernel;

class KernelServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['controller_resolver'] = function($c) {
            return new HttpKernel\Controller\ControllerResolver();
        };
        $app['argument_resolver'] = function($c) {
            return new HttpKernel\Controller\ArgumentResolver();
        };
    }
}

