<?php

namespace App\Controllers;

class CurrencyConverterController extends Controller
{
    public function index($request, $response)
    {
        return $this->view->render($response, 'currency-converter/index.twig');
    }
}