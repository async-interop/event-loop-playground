<?php

namespace Playground;

use Amp\Deferred;
use Interop\Async\EventLoop\EventLoop;

require __DIR__ . "/vendor/autoload.php";

EventLoop::execute(function () {
    $deferred = new Deferred;

    $deferred->promise()->when(function($error, $value) {
        if ($error) {
            var_dump($error);
        } else {
            var_dump($value);
        }
    });

    EventLoop::execute(function () {
        var_dump(__LINE__);

        EventLoop::execute(function () {
            var_dump(__LINE__);
        }, new AmpDriver(\Amp\driver()));
    }, new AmpDriver(\Amp\driver()));

    EventLoop::delay(function() use ($deferred) {
        $deferred->succeed(__LINE__);
    }, 1000);
}, new AmpDriver(\Amp\driver()));