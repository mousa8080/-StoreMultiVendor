<?php
namespace App\Helpers;

use NumberFormatter;

class Currency{
    public function __invoke(...$params)
    {
      return  static::format(...$params);
    }
    public function format($amount,$currency=null){
        $formatcurrency= new NumberFormatter(config('app.locale'),NumberFormatter::CURRENCY);
        if($currency==null){
            $currency= config('app.currency','USD');
        }
            return $formatcurrency->formatCurrency($amount,$currency);
    }

}