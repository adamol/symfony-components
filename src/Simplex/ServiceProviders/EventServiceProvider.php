<?php

namespace Simplex\ServiceProviders;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\HttpKernel;
use Symfony\Component\EventDispatcher\EventDispatcher;

class EventServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
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
    }
}
