<?php
declare(strict_types=1);

use App\Controllers\CurrencyConverterController;
use Slim\App;

return function (App $app) {

    $app->get('/', CurrencyConverterController::class . ':index');
};
