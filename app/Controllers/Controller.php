<?php

namespace App\Controllers;

use Psr\Container\ContainerInterface;

abstract class Controller
{
    protected $view;

    public function __construct(ContainerInterface $container)
    {
        $this->view = $container->get('view');
    }
}