<?php
declare(strict_types=1);

use DI\Container;

return function (Container $container) {
    $container->set('settings', function () {
        return [
            'displayErrorDetails' => true,
            'logErrors' => true,
            'logErrorDetails' => true,
            'views' => [
                'path' => __DIR__ . '/../resource/views',
                'settings' => ['cache' => false]
            ]
        ];
    });
};