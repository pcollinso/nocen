<?php

namespace App\Http;

class RemitaClient
{
  private static $baseUrl = 'https://login.remita.net';
  private static $apiKey = '510348';

  public static function getPayment(string $merchantId, string $orderId) : array
  {
    $hash = hash('sha512', $orderId . self::$apiKey . $merchantId);
    $ch = curl_init();
    curl_setopt_array($ch, [
      CURLOPT_URL => "$baseUrl/remita/ecomm/$merchantId/$orderId/$hash/orderstatus.reg",
      CURLOPT_RETURNTRANSFER => true
    ]);
    $output = curl_exec($ch);
    curl_close($ch);

    return json_decode($output, true);
  }

  public static function isErrorResponse(array &$data) : bool
  {
    return $data['status'] ?? 0 != '00';
  }
}
