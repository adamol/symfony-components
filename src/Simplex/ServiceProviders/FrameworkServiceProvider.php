<?php

namespace Simplex\ServiceProviders;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class FrameworkServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['framework'] = function($c) {
            return new \Simplex\Framework(
                $c['dispatcher'],
                $c['controller_resolver'],
                $c['request_stack'],
                $c['argument_resolver']
            );
        };
    }
}
