<?php

namespace App\Http;

class EtranzactClient
{
  private static $ERR_RESPONSE = ['error' => 'No response.Service error!'];

  public static function getPayment(string $terminalId, string $confirmationCode) : array
  {
    $ch = curl_init();
    curl_setopt_array($ch, [
      CURLOPT_URL => "https://www.etranzact.net/WebConnectPlus/query.jsp?TERMINAL_ID=$terminalId&CONFIRMATION_NO=$confirmationCode",
      CURLOPT_RETURNTRANSFER => true
    ]);
    $output = curl_exec($ch);
    curl_close($ch);

    $output = trim(strip_tags(urldecode($output)));

    if(str_contains($output, 'RECEIPT_NO='))
    {
      return array_reduce(explode('&', $output), function ($arr, $str) {
        [$k, $v] = explode('=', $str);
        return array_merge($arr, [$k => $v]);
      }, ['CONFIRMATION_NO' => $confirmationCode, 'TERMINAL_ID' => $terminalId]);
    }

    return self::$ERR_RESPONSE;
  }

  public static function isErrorResponse(array &$data) : bool
  {
    return $data == self::$ERR_RESPONSE;
  }
}
