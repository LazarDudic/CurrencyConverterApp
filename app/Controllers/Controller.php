<?php

namespace App\Controllers;

use Psr\Container\ContainerInterface;
use Slim\App;

abstract class Controller
{
    protected $error;
    protected $view;

    public function __construct(ContainerInterface $container)
    {
        $this->error = null;
        $this->view = $container->get('view');
    }
}