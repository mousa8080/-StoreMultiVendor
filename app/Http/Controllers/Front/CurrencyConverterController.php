<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;


class CurrencyConverterController extends Controller
{
    public function convert(Request $request)
    {
        $request->validate([
            'from' => 'required|string|size:3',
            'to' => 'required|string|size:3',
            'amount' => 'nullable|numeric|min:0',
        ]);
        $from = $request->input('from');
        $to = $request->input('to');
        $amount = $request->input('amount', 1);
        $rates = Cache::get('currency_rate', []);

        if (isset($rates[$from]) && isset($rates[$to])) {
            $rate = $rates[$to] / $rates[$from];
            $convertedAmount = $amount * $rate;

            Cache::put('currency_rate', $rate, now()->addMinutes(60));
            return response()->json([
                'from' => $from,
                'to' => $to,
                'original_amount' => $amount,
                'converted_amount' => $convertedAmount,
            ]);
        }

        $apiKey = config('services.currency_converter.api_key');
        Session::put('currency_api_key', $apiKey);

        $converter = new \App\Services\ConverterCrruncy($apiKey);
        $convertedAmount = $converter->convert($from, $to, $amount);
        $rate = $convertedAmount / $amount;
        Cache::put('currency_rate', $rate, now()->addMinutes(60));

        Session::put('currency_rate', $rate);

        return response()->json([
            'from' => $from,
            'to' => $to,
            'original_amount' => $amount,
            'converted_amount' => $convertedAmount,
        ]);
    }
}
