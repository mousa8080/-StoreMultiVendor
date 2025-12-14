<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ConverterCrruncy
{
  private $apiKey;
  protected $base_url = "https://api.freecurrencyapi.com/v1/latest?apikey=fca_live_Xc9zsOhPuvnsTc1ITP8Vf5TN5JxenQfnK0U8jPWI";
  public function __construct(string $apiKey)
  {
    $this->apiKey = $apiKey;
  }
  public function convert($from, $to, $amount = 1)
  {
    $request =  Http::baseUrl($this->base_url)
      ->get('convert', [
        'amount' => $amount,
        'from' => $from,
        'to' => $to,
        'apikey' => $this->apiKey,
      ]);
    $result = $request->json();
    return $result['data'][$to] ?? 0;
  }
}
