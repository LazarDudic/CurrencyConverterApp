<?php

namespace App\Controllers;

use App\Services\Currency;
use App\Validation\Validate;

class CurrencyConverterController extends Controller
{
    public function index($request, $response)
    {
        $requestedCurrency = $this->getRequestedName($request);
        $requestedDate = $this->getRequestedDate($request);
        $currency = new Currency($requestedCurrency, $requestedDate);
        $rates = $currency->getRates();
        $error = $this->error;

        return $this->view->render($response, 'currency-converter/index.twig', compact(
            'rates','requestedCurrency', 'requestedDate', 'error'
        ));
    }

    protected function getRequestedName($request)
    {
        if (isset($request->getQueryParams()['currency'])) {
            $requestedCurrency = $request->getQueryParams()['currency'];
            $validate = new Validate();

            if ($validate->currency($requestedCurrency)) {
                return $requestedCurrency;
            }
        }

        return 'EUR';
    }

    private function getRequestedDate($request)
    {
        if (isset($request->getQueryParams()['date'])) {
            $requestedDate = $request->getQueryParams()['date'];

            $validate = new Validate();

            if ($validate->date($requestedDate)) {
                if (
                    strtotime($requestedDate) > strtotime(date('Y-m-d', time())) ||
                    strtotime($requestedDate) < strtotime(date('Y-m-d', strtotime('1999-01-01')))
                ) {
                    $this->error = 'Currency is unavailable for requested date';
                }
                return $requestedDate;
            }

        }

        return date('Y-m-d', time());
    }


}