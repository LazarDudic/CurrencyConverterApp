<?php

namespace App\Services;

class Currency
{
    private $rates;

    public function __construct($name)
    {
        $url = 'https://api.exchangeratesapi.io/latest?base='.$name;
        $this->rates = json_decode(file_get_contents($url), true)['rates'];
    }

    public function getRates()
    {
        return $this->rates;
    }

    public function calculate($currency, $amount)
    {
        return $this->rates[$currency] * $amount;
    }

}