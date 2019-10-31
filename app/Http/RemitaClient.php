<?php

namespace App\Http;

class RemitaClient
{
  private static $apiKey = '510348';

  public static function generateHash(string $merchantId, string $rrr) : string
  {
    return hash('sha512', $merchantId . $rrr . self::$apiKey);
  }

  public static function getPayment(string $merchantId, string $orderId) : array
  {
    $hash = hash('sha512', $orderId . self::$apiKey . $merchantId);
    $ch = curl_init();
    curl_setopt_array($ch, [
      CURLOPT_URL => "https://login.remita.net/remita/ecomm/$merchantId/$orderId/$hash/orderstatus.reg",
      CURLOPT_RETURNTRANSFER => true
    ]);
    $output = curl_exec($ch);
    curl_close($ch);

    return json_decode($output, true);
  }

  public static function getRrr(array &$data) : array
  {
    $merchantId = $data['applicant']->institution->terminal_id;
    $hash = hash('sha512', 
      $merchantId . 
      $data['applicant']->field->programme->service_type_id . 
      $data['orderId'] . 
      $data['fee']->amount . 
      self::$apiKey);

    $c = curl_init();
    curl_setopt_array($c, [
      CURLOPT_URL => 'https://login.remita.net/remita/exapp/api/v1/send/api/echannelsvc/merchant/api/paymentinit',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => json_encode([
        "serviceTypeId" => $data['applicant']->field->programme->service_type_id,
        "amount" => $data['fee']->amount,
        "hash" => $hash,
        "orderId" => $data['orderId'],
        "payerName" => $data['applicant']->full_name,
        "payerEmail" => $data['applicant']->email,
        "payerPhone" => $data['applicant']->phone,
        "description" => $data['fee']->fee_description,
        "lineItems" => [
          [
            'lineItemsId' => 'itemid1',
            'beneficiaryName' => 'Nwafor Orizu College Of Education Nsugbe',
            'beneficiaryAccount' => '4110012615',
            'bankCode' => '070',
            'beneficiaryAmount' => '' . ($data['fee']->amount - 1000),
            'deductFeeFrom' => '1'
          ],
          [
            'lineItemsId' => "34444{$data['orderId']}",
            'beneficiaryName' => 'Consolidated fortunes Nigeria Limited',
            'beneficiaryAccount' => '4010818395',
            'bankCode' => '070',
            'beneficiaryAmount' => '1000',
            'deductFeeFrom' => '0'
          ],
          [
            'lineItemsId' => "34444{$data['orderId']}",
            'beneficiaryName' => 'Sanod Integrated Services',
            'beneficiaryAccount' => '4010854704',
            'bankCode' => '070',
            'beneficiaryAmount' => '100',
            'deductFeeFrom' => '0'
          ]
        ]
      ]),
      CURLOPT_HTTPHEADER => [
        "Authorization: remitaConsumerKey=$merchantId,remitaConsumerToken=$hash",
        'Content-Type: application/json',
        'cache-control: no-cache'
      ]
    ]);
    $json_response = curl_exec($c);
    $err = curl_error($c);
    curl_close($c);

    return json_decode(substr($json_response, 7, -1), true);
  }
}
