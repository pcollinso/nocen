<?php

namespace App\Http;

class EtranzactClient
{
  const ERR_RESPONSE = ['error' => 'No response.Service error!'];

  public static function getPayment(string $terminalId, string $confirmationCode) : array
  {
    $ch = curl_init();
    curl_setopt_array($ch, [
      CURLOPT_URL => "https://www.etranzact.net/WebConnectPlus/query.jsp?TERMINAL_ID=$terminalId&CONFIRMATION_NO=$confirmationCode",
      CURLOPT_RETURNTRANSFER => true
    ]);
    $output = curl_exec($ch);
    curl_close($ch);

    if(! empty($output))
    {
      return array_reduce(explode('&', urldecode($output)), function ($arr, $str) {
        [$k, $v] = explode('=', $str);
        return array_merge($arr, [$k => $v]);
      }, []);
    }

    return ERR_RESPONSE;
  }

  public static function isErrorResponse(array &$data) : bool
  {
    return $data == ERR_RESPONSE;
  }
}
