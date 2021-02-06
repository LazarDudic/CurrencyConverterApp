<?php

namespace App\Controllers;

use App\Services\Currency;
use App\Validation\Validate;

class CurrencyCalculateController extends CurrencyConverterController
{
    public function index($request, $response)
    {
        $requestedCurrency = $this->getRequestedName($request);
        $convertCurrency = $this->getConvertCurrency($request);
        $amount = $this->getRequestedAmount($request);

        $currency = new Currency($requestedCurrency);
        $rates = $currency->getRates();
        $total = $currency->calculate($convertCurrency, $amount);

        return $this->view->render($response, 'currency-calculate/index.twig',
            compact('rates', 'total', 'requestedCurrency', 'convertCurrency', 'amount')
        );
    }

    protected function getConvertCurrency($request)
    {
        if (isset($request->getQueryParams()['convert_to'])) {
            $requestedCurrency = $request->getQueryParams()['convert_to'];
            $validate = new Validate();

            if ($validate->currency($requestedCurrency)) {
                return $requestedCurrency;
            }
        }

        return 'USD';
    }

    protected function getRequestedAmount($request)
    {
        if (isset($request->getQueryParams()['amount'])) {
            $requestedAmount = $request->getQueryParams()['amount'];
            $validate = new Validate();

            if ($validate->number($requestedAmount)) {
                return $requestedAmount;
            }
        }

        return 1;
    }

}