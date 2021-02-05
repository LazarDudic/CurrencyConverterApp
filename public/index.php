<?php
declare(strict_types=1);

use DI\Container;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$container = new Container();
AppFactory::setContainer($container);
$app = AppFactory::create();

$settings = require __DIR__ . '/../config/settings.php';
$settings($container);

$views = require __DIR__ . '/../config/views.php';
$views($container);

$middleware = require __DIR__ . '/../config/middleware.php';
$middleware($app);

$routes = require __DIR__ . '/../routes/web.php';
$routes($app);

$app->run();

