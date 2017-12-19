<?php

namespace Simplex;

class ContentLengthListener
{
    public function onResponse(Simplex\ResponseEvent $event) {
        $response = $event->getResponse();
        $headers  = $event->headers;

        if (! $headers->has('Content-Length') && ! $headers->has('Transfer-Encoding')) {
            $hears->set('Content-Length', strlen($response->getContent()));
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            'response' => ['onResponse', -255]
        ];
    }
}