<?php
namespace App\Utils;

use App\Http\EtranzactClient;
use App\Models\Applicant;
use App\Models\Payment;
use App\Models\Fee;
use App\Models\FeeType;
use DB;

final class PaymentConfirmation
{

  public static function confirmApplicationFee(Applicant $applicant, array $etranzactResponse, string $fee) : array
  {
    if ($applicant->j_regno != $etranzactResponse['CUSTOMER_ID'])
    {
      return ['success' => false, 'message' => "Payment record does not belong to applicant", 'data' => null];
    }

    if(Payment::where('confirmation_no', $etranzactResponse['CONFIRMATION_NO'])->exists())
    {
      return ['success' => false, 'message' => "Confirmation pin already used!", 'data' => null];
    }

    $amount = $etranzactResponse['TRANS_AMOUNT'] ?? 0; // amount

    // This is commented out as fee type from Etranzact is not same as fee type in database
    // $feeType = FeeType::where('fee_type', $etranzactResponse['TYPE_NAME'])->first();
    $feeType = FeeType::where('fee_type', $fee)->first();

    if(! $feeType)
    {
      return ['success' => false, 'message' => "Fee type not found!", 'data' => null];
    }

    $levelId = 1;
    $regno = null;
    $applicant->loadMissing(['field', 'utme', 'olevelResults', 'nextOfKins']);

    $query = "SELECT sf.* FROM sch_fee sf";
    $query .= " INNER JOIN sup_institution si ON sf.institution_id=si.id";
    $query .= " INNER JOIN sch_fee_type sft ON sf.fee_type_id=sft.id";
    $query .= " INNER JOIN sys_payment_type spt ON sf.payment_type_id=spt.id";
    $query .= " INNER JOIN sys_application_level sal ON sf.application_level_id = sal.id";
    $query .= " AND (";
    $query .= " ((sf.j_regno = ? OR sf.j_regno = '0') AND sal.id = 1)";
    $query .= " OR ((sf.regno = ? OR sf.regno = '0') AND sal.id = 2)";
    $query .= " OR ((sf.field_id = ? OR sf.field_id = '0') AND sal.id = 3)";
    $query .= " OR ((sf.field_id = ? OR sf.field_id = '0') AND (sf.level_id = ? OR sf.level_id = '0') AND sal.id = 4)";
    $query .= " OR ((sf.department_id = ? OR sf.department_id = '0') AND sal.id = 5)";
    $query .= " OR ((sf.department_id = ? OR sf.department_id = '0') AND (sf.level_id = ? OR sf.level_id = '0') AND sal.id = 6)";
    $query .= " OR ((sf.faculty_id = ? OR sf.faculty_id = '0') AND sal.id = 7)";
    $query .= " OR ((sf.faculty_id = ? OR sf.faculty_id = '0') AND (sf.level_id = ? OR sf.level_id = '0') AND sal.id = 8)";
    $query .= " OR ((sf.programme_id = ? OR sf.programme_id = '0') AND sal.id = 9)";
    $query .= " OR ((sf.programme_id = ? OR sf.programme_id = '0') AND (sf.level_id = ? OR sf.level_id = '0') AND sal.id = 10)";
    $query .= " OR ((sf.institution_id = ? OR sf.institution_id = '0') AND sal.id = 11)";
    $query .= " OR ((sf.institution_id = ? OR sf.institution_id = '0') AND (sf.level_id = ? OR sf.level_id = '0') AND sal.id = 12)";
    $query .= " )";
    $query .= " WHERE sf.active = 1 and sf.fee_type_id = ? and sf.institution_id = ?";

    $fee = DB::select($query, [
      $applicant->j_regno,
      $regno,
      $applicant->field->id,
      $applicant->field->id,$levelId,
      $applicant->field->department_id,
      $applicant->field->department_id,$levelId,
      $applicant->field->faculty_id,
      $applicant->field->faculty_id,$levelId,
      $applicant->field->programme_id,
      $applicant->field->programme_id,$levelId,
      $applicant->field->institution_id,
      $applicant->field->institution_id,$levelId,
      $feeType->id,$applicant->field->institution_id
    ]);

    $fee = array_shift($fee);

    if (! $fee)
    {
      return ['success' => false, 'message' => "Fee type not found!", 'data' => null];
    }

    if($fee->is_one_off &&
      ! in_array($fee->amount, [$amount, $amount + 100, $amount - 10]))
    {
      return ['success' => false, 'message' => "Invalid fee amount paid!", 'data' => null];
    }


    $feeDetail = $fee->is_one_off ?
      $fee :
      Fee::where([
        ['application_level_id', $fee->application_level_id],
        ['fee_type_id', $fee->fee_type_id],
        ['institution_id', $applicant->field->institution_id],
        ['active', 1]
      ])
      ->whereIn('amount', [$amount, $amount + 100, $amount - 10])
      ->first();

    if (! $fee->is_one_off && ! $feeDetail)
    {
      return ['success' => false, 'message' => "Invalid fee amount paid!", 'data' => null];
    }

    $uniqueParams = [
      'j_regno' => $applicant->j_regno,
      'regno' => $regno,
      'receipt_no' => $etranzactResponse['RECEIPT_NO'] ?? '',
      'institution_id' => $applicant->field->institution_id,
      'fee_id' => $fee->fee_type_id,
    ];

    $rest = [
      'confirmation_no' => $etranzactResponse['CONFIRMATION_NO'],
      'payment_type_id' => $feeDetail->payment_type_id,
      'level_id' => $levelId,
      'amount' => $feeDetail->amount,
      'terminal_id' => $etranzactResponse['TERMINAL_ID'],
      'payment_code' => $etranzactResponse['PAYMENT_CODE'] ?? '',
      'merchant_code' => $etranzactResponse['MERCHANT_CODE'] ?? '',
      'payment_date' => $etranzactResponse['TRANS_DATE'] ?? '',
      'payment_description' => $etranzactResponse['TRANS_DESCR'] ?? '',
      'cbn_code' => $etranzactResponse['BANK_CODE'] ?? '',
      'bank_name' => $etranzactResponse['BANK_NAME'] ?? '',
      'bank_branch' => $etranzactResponse['BRANCH_NAME'] ?? '',
      'lead_bank_code' => $etranzactResponse['LEAD_BANK_CODE'] ?? '',
      'lead_bank_name' => $etranzactResponse['LEAD_BANK_NAME'] ?? '',
      'customer_name' => $etranzactResponse['CUSTOMER_NAME'] ?? '',
      'teller_id' => $etranzactResponse['TELLER_ID'] ?? '',
      'payment_method' => $etranzactResponse['PAYMENT_METHOD_NAME'] ?? '',
      'payment_currency' => $etranzactResponse['PAYMENT_CURRENCY'] ?? '',
      'transaction_type' => $etranzactResponse['TRANS_TYPE'] ?? '',
      'payment_fee_type' => $etranzactResponse['TYPE_NAME'] ?? ''
    ];

    Payment::unguard();
    $paymentInfo = Payment::updateOrCreate($uniqueParams, $rest);
    Payment::reguard();

    return ['success' => true, 'message' => 'Payment confirmed', 'data' => $paymentInfo];
  }

}
