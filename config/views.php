<?php
declare(strict_types=1);

use Slim\Views\Twig;

return function (DI\Container $container) {
    $container->set('view', function($container) {
        $views = $container->get('settings')['views'];
        return Twig::create($views['path'], $views['settings']);
    });
};