<?php

namespace App\Services;

class Currency
{
    private $rates;

    public function __construct($name, $date = null)
    {
        $date = $date ?? date('Y-m-d', time());
        $url = 'https://api.exchangeratesapi.io/'.$date.'?base='.$name;
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