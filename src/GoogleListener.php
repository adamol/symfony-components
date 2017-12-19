<?php

namespace Simple;

class GoogleListener
{
    public function onResponse(ResponseEvent $event) {
        $response = $event->getResponse();

        $responseIsHtml = $response->headers->has('Content-Type') && false !== strpos($response->headers->get('Content-Type'), 'html');

        $htmlIsRequested = 'html' === $event->getRequest()->getRequestFormat();

        if (! $response->isRedirection() && $htmlIsRequested && $responseIsHtml) {
            $response->setContent($response->getContent(), 'GA CODE');
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            'response' => 'onResponse'
        ];
    }
}