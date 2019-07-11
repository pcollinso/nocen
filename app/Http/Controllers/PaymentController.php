<?php
namespace App\Http\Controllers;

use App\Http\EtranzactClient;
use App\Models\Applicant;
use App\Models\Student;
use App\Models\Payment;
use App\Utils\Utility;
use App\Models\Fee;
use App\Models\FeeType;
use App\Models\ApplicationLevel;
use App\Models\FeeCheckExclusion;
use App\Models\PaymentType;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{

    public function test()
    {
        /*$getImage = Utility::getConvertImage(array(
            'file_path' => "http%3A%2F%2Flocalhost%2Fcol%2Fassets%2Fimg%2Fuser-4.jpg",
            'width' => 300,
            'height' => 300,
            'format' => 'jpg',
            'save_path' => public_path('images/biometric/applicant/'.'86354555FF'.'.jpg'),
            'quality' => 60));dd($getImage);*/
        // jambite
        /*$output = urldecode("RECEIPT_NO=0701809211271298&PAYMENT_CODE=07025701271537524516111&MERCHANT_CODE=0701300039&TRANS_AMOUNT=800.0&TRANS_DATE=2018/09/21 10:08:48&TRANS_DESCR=APPLICATION_FEE-86354555FF-OKEZIE%20CHIDIMMA&CUSTOMER_ID=86354555FF&BANK_CODE=070&BRANCH_CODE=130&SERVICE_ID=86354555FF&CUSTOMER_NAME=OKEZIE%20CHIDIMMA&CUSTOMER_ADDRESS=.&TELLER_ID=Ma.Okeke&USERNAME=N/A&PASSWORD=N/A&BANK_NAME=Fidelity%20Bank&BRANCH_NAME=NSUGBE%20BRANCH&CHANNEL_NAME=Bank&PAYMENT_METHOD_NAME=Cash&PAYMENT_CURRENCY=566&TRANS_TYPE=RCO1&TRANS_FEE=0.0&TYPE_NAME=APPLICATION_FEE&LEAD_BANK_CODE=070&LEAD_BANK_NAME=Fidelity%20Bank");*/
        // student
        /*$output = urldecode("RECEIPT_NO=0701809211271390&PAYMENT_CODE=07025701271537524516222&MERCHANT_CODE=0701300039&TRANS_AMOUNT=40250.0&TRANS_DATE=2018/09/21 10:08:48&TRANS_DESCR=SCHOOL_FEE-2006131498-PETER%20NELSON&CUSTOMER_ID=2006131498&BANK_CODE=070&BRANCH_CODE=130&SERVICE_ID=86354555FF&CUSTOMER_NAME=PETER%20NELSON%20ANDREW&CUSTOMER_ADDRESS=.&TELLER_ID=Ma.Okeke&USERNAME=N/A&PASSWORD=N/A&BANK_NAME=Fidelity%20Bank&BRANCH_NAME=NSUGBE%20BRANCH&CHANNEL_NAME=Bank&PAYMENT_METHOD_NAME=Cash&PAYMENT_CURRENCY=566&TRANS_TYPE=RCO1&TRANS_FEE=0.0&TYPE_NAME=SCHOOL_FEE&LEAD_BANK_CODE=070&LEAD_BANK_NAME=Fidelity%20Bank");*/
        dd(self::checkPayment(array('TERMINAL_ID' => "7009158828", 'CONFIRMATION_NO' => "07025701271537524516333", 'USER' => '2006131498','USER_TYPE' => 'student')));

    }

    public static function checkPayment($data)
    {
        $main = EtranzactClient::getPayment($data['TERMINAL_ID'], $data['CONFIRMATION_NO']);
        $main['USER'] = $data['USER'] ?? '';
        $main['USER_TYPE'] = $data['USER_TYPE'] ?? '';
        if (!isset($main['error'])) {
            if (!empty($main['TRANS_AMOUNT'])) {
                return response()->json(self::confirmPayment($main), 200);
            }
        }else{
            return response()->json(['success' => false, 'message' => 'Payment confirmation failed: '.$main['error'], 'data' => []], 200);
        }
        return response()->json(['success' => false, 'message' => 'Payment confirmation failed: Confirmation_no invalid', 'data' => []], 200);
    }

    public static function confirmApplicantPayment($main)
    {
        $TRANS_AMOUNT = $main['TRANS_AMOUNT'] ?? ''; // amount
        $RECEIPT_NO = $main['RECEIPT_NO'] ?? ''; // receipt_no
        $PAYMENT_CODE = $main['PAYMENT_CODE'] ?? ''; // payment_code
        $MERCHANT_CODE = $main['MERCHANT_CODE'] ?? ''; // merchant_code
        $TRANS_DATE = $main['TRANS_DATE'] ?? ''; // payment_date
        $TRANS_DESCR = $main['TRANS_DESCR'] ?? ''; // payment_description
        $CUSTOMER_ID = $main['CUSTOMER_ID'] ?? ''; // regno or j_regno
        $BANK_CODE = $main['BANK_CODE'] ?? ''; // cbn_code
        $CUSTOMER_NAME = $main['CUSTOMER_NAME'] ?? ''; // customer_name
        $TELLER_ID = $main['TELLER_ID'] ?? ''; // teller_id
        $BANK_NAME = $main['BANK_NAME'] ?? ''; // bank_name
        $BRANCH_NAME = $main['BRANCH_NAME'] ?? ''; // bank_branch
        $PAYMENT_METHOD_NAME = $main['PAYMENT_METHOD_NAME'] ?? ''; // payment_method
        $PAYMENT_CURRENCY = $main['PAYMENT_CURRENCY'] ?? ''; // payment_currency
        $TYPE_NAME = $main['TYPE_NAME'] ?? ''; // payment_fee_type
        $TRANS_TYPE = $main['TRANS_TYPE'] ?? ''; //  transaction_type
        $LEAD_BANK_CODE = $main['LEAD_BANK_CODE'] ?? ''; // lead_bank_code
        $LEAD_BANK_NAME = $main['LEAD_BANK_NAME'] ?? ''; // lead_bank_name
        $CONFIRMATION_NO = $main['CONFIRMATION_NO'] ?? ''; // confirmation_no
        $TERMINAL_ID = $main['TERMINAL_ID'] ?? ''; // terminal_id

        $fee_type = FeeType::where('fee_type', $main['TYPE_NAME'])->first();
        if(!$fee_type) return array('success' => false, 'message' => "Payment confirmation failed: Fee type not found!", 'data' => []); else $fee_type_id = $fee_type->id;

        $level_id = 1;
        $j_regno = $CUSTOMER_ID;
        $regno = null;
        $applicant_detail = Applicant::where('j_regno', $j_regno)->first();
        if($applicant_detail){
            $applicant_detail->load(['field','utme','olevelResults','nextOfKins']);
            if($applicant_detail->field){
                $programme_id = $applicant_detail->field->programme_id;
                $faculty_id = $applicant_detail->field->faculty_id;
                $department_id = $applicant_detail->field->department_id;
                $field_id = $applicant_detail->field->id;
                $institution_id = $applicant_detail->field->institution_id;

                $fee = DB::select("SELECT sf.*
FROM sch_fee sf 
INNER JOIN sup_institution si ON sf.institution_id=si.id 
INNER JOIN sch_fee_type sft ON sf.fee_type_id=sft.id 
INNER JOIN sys_payment_type spt ON sf.payment_type_id=spt.id
INNER JOIN sys_application_level sal ON sf.application_level_id = sal.id and (
((sf.j_regno = ? or sf.j_regno = '0') and sal.id = 1)
or ((sf.regno = ? or sf.regno = '0') and sal.id = 2)
or ((sf.field_id = ? or sf.field_id = '0') and sal.id = 3)
or ((sf.field_id = ? or sf.field_id = '0') and (sf.level_id = ? or sf.level_id = '0') and sal.id = 4)
or ((sf.department_id = ? or sf.department_id = '0') and sal.id = 5)
or ((sf.department_id = ? or sf.department_id = '0') and (sf.level_id = ? or sf.level_id = '0') and sal.id = 6)
or ((sf.faculty_id = ? or sf.faculty_id = '0') and sal.id = 7)
or ((sf.faculty_id = ? or sf.faculty_id = '0') and (sf.level_id = ? or sf.level_id = '0') and sal.id = 8)
or ((sf.programme_id = ? or sf.programme_id = '0') and sal.id = 9)
or ((sf.programme_id = ? or sf.programme_id = '0') and (sf.level_id = ? or sf.level_id = '0') and sal.id = 10)
or ((sf.institution_id = ? or sf.institution_id = '0') and sal.id = 11)
or ((sf.institution_id = ? or sf.institution_id = '0') and (sf.level_id = ? or sf.level_id = '0') and sal.id = 12)
      )    
WHERE sf.active = 1 and sf.fee_type_id=? and sf.institution_id = ? limit 1"
                    ,[
                        $j_regno,
                        $regno,
                        $field_id,
                        $field_id,$level_id,
                        $department_id,
                        $department_id,$level_id,
                        $faculty_id,
                        $faculty_id,$level_id,
                        $programme_id,
                        $programme_id,$level_id,
                        $institution_id,
                        $institution_id,$level_id,
                        $fee_type_id,$institution_id
                    ]
                );
                if(count($fee)){
                    $fee_application_level_id = $fee[0]->application_level_id;
                    $fee_type_id = $fee[0]->fee_type_id;
                    $is_one_off = $fee[0]->is_one_off;
                    if($is_one_off){
                        $fee_detail = $fee[0];
                        if(!in_array($fee[0]->amount, array($TRANS_AMOUNT, $TRANS_AMOUNT + 100, $TRANS_AMOUNT - 10))){
                            return array('success' => false, 'message' => "Payment confirmation failed: invalid fee amount paid!", 'data' => []);
                        }
                    }else{
                        $fee_detail = Fee::where(array(
                            ['application_level_id', $fee_application_level_id],
                            ['fee_type_id', $fee_type_id],
                            ['institution_id', $institution_id],
                            ['active', 1]
                        ))->whereIn('amount', array($TRANS_AMOUNT, $TRANS_AMOUNT + 100, $TRANS_AMOUNT - 10))->first();
                        if(!$fee_detail){
                            return array('success' => false, 'message' => "Payment confirmation failed: invalid fee amount paid!", 'data' => []);
                        }
                    }
                    if($fee_detail){
                        $data = [
                            [
                                'fee_id' => $fee_type_id,
                                'payment_type_id' => $fee_detail->payment_type_id,
                                'institution_id' =>$institution_id,
                                'level_id' => $level_id,
                                'j_regno' => $j_regno,
                                'regno' => $regno,
                                'amount' => $fee_detail->amount,
                                'confirmation_no' => $CONFIRMATION_NO,
                                'receipt_no' => $RECEIPT_NO,
                                'terminal_id' => $TERMINAL_ID,
                                'payment_code' => $PAYMENT_CODE,
                                'merchant_code' => $MERCHANT_CODE,
                                'payment_date' => $TRANS_DATE,
                                'payment_description' => $TRANS_DESCR,
                                'cbn_code' => $BANK_CODE,
                                'bank_name' => $BANK_NAME,
                                'bank_branch' => $BRANCH_NAME,
                                'lead_bank_code' => $LEAD_BANK_CODE,
                                'lead_bank_name' => $LEAD_BANK_NAME,
                                'customer_name' => $CUSTOMER_NAME,
                                'teller_id' => $TELLER_ID,
                                'payment_method' => $PAYMENT_METHOD_NAME,
                                'payment_currency' => $PAYMENT_CURRENCY,
                                'transaction_type' => $TRANS_TYPE,
                                'payment_fee_type' => $TYPE_NAME
                            ]
                        ];
                        Payment::insertIgnore($data); return array('success' => true, 'message' => 'Payment confirmed', 'data' => []);
                    }

                }else{
                    return array('success' => false, 'message' => "Payment confirmation failed: Fee type not found!", 'data' => []);
                }
            }else{
                return array('success' => false, 'message' => "Payment confirmation failed: fee record not found!", 'data' => []);
            }
        }else{
            return array('success' => false, 'message' => "Payment confirmation failed: User record not found!", 'data' => []);
        }
    }

    public static function confirmStudentPayment($main)
    {
        $TRANS_AMOUNT = $main['TRANS_AMOUNT'] ?? ''; // amount
        $RECEIPT_NO = $main['RECEIPT_NO'] ?? ''; // receipt_no
        $PAYMENT_CODE = $main['PAYMENT_CODE'] ?? ''; // payment_code
        $MERCHANT_CODE = $main['MERCHANT_CODE'] ?? ''; // merchant_code
        $TRANS_DATE = $main['TRANS_DATE'] ?? ''; // payment_date
        $TRANS_DESCR = $main['TRANS_DESCR'] ?? ''; // payment_description
        $CUSTOMER_ID = $main['CUSTOMER_ID'] ?? ''; // regno or j_regno
        $BANK_CODE = $main['BANK_CODE'] ?? ''; // cbn_code
        $CUSTOMER_NAME = $main['CUSTOMER_NAME'] ?? ''; // customer_name
        $TELLER_ID = $main['TELLER_ID'] ?? ''; // teller_id
        $BANK_NAME = $main['BANK_NAME'] ?? ''; // bank_name
        $BRANCH_NAME = $main['BRANCH_NAME'] ?? ''; // bank_branch
        $PAYMENT_METHOD_NAME = $main['PAYMENT_METHOD_NAME'] ?? ''; // payment_method
        $PAYMENT_CURRENCY = $main['PAYMENT_CURRENCY'] ?? ''; // payment_currency
        $TYPE_NAME = $main['TYPE_NAME'] ?? ''; // payment_fee_type
        $TRANS_TYPE = $main['TRANS_TYPE'] ?? ''; //  transaction_type
        $LEAD_BANK_CODE = $main['LEAD_BANK_CODE'] ?? ''; // lead_bank_code
        $LEAD_BANK_NAME = $main['LEAD_BANK_NAME'] ?? ''; // lead_bank_name
        $CONFIRMATION_NO = $main['CONFIRMATION_NO'] ?? ''; // confirmation_no
        $TERMINAL_ID = $main['TERMINAL_ID'] ?? ''; // terminal_id

        $fee_type = FeeType::where('fee_type', $main['TYPE_NAME'])->first();
        if(!$fee_type) return array('success' => false, 'message' => "Payment confirmation failed: Fee type not found!", 'data' => []); else $fee_type_id = $fee_type->id;

        $j_regno = null;
        $regno = $CUSTOMER_ID;
        $student_detail = Student::where('regno', $regno)->first();
        if($student_detail){
            $student_detail->load(['field','olevelResults','nextOfKins']);
            if($student_detail->field){
                $programme_id = $student_detail->field->programme_id;
                $faculty_id = $student_detail->field->faculty_id;
                $department_id = $student_detail->field->department_id;
                $field_id = $student_detail->field->id;
                $institution_id = $student_detail->field->institution_id;
                $level_id = $student_detail->level_id;

                $fee = DB::select("SELECT sf.*
FROM sch_fee sf 
INNER JOIN sup_institution si ON sf.institution_id=si.id 
INNER JOIN sch_fee_type sft ON sf.fee_type_id=sft.id 
INNER JOIN sys_payment_type spt ON sf.payment_type_id=spt.id
INNER JOIN sys_application_level sal ON sf.application_level_id = sal.id and (
((sf.j_regno = ? or sf.j_regno = '0') and sal.id = 1)
or ((sf.regno = ? or sf.regno = '0') and sal.id = 2)
or ((sf.field_id = ? or sf.field_id = '0') and sal.id = 3)
or ((sf.field_id = ? or sf.field_id = '0') and (sf.level_id = ? or sf.level_id = '0') and sal.id = 4)
or ((sf.department_id = ? or sf.department_id = '0') and sal.id = 5)
or ((sf.department_id = ? or sf.department_id = '0') and (sf.level_id = ? or sf.level_id = '0') and sal.id = 6)
or ((sf.faculty_id = ? or sf.faculty_id = '0') and sal.id = 7)
or ((sf.faculty_id = ? or sf.faculty_id = '0') and (sf.level_id = ? or sf.level_id = '0') and sal.id = 8)
or ((sf.programme_id = ? or sf.programme_id = '0') and sal.id = 9)
or ((sf.programme_id = ? or sf.programme_id = '0') and (sf.level_id = ? or sf.level_id = '0') and sal.id = 10)
or ((sf.institution_id = ? or sf.institution_id = '0') and sal.id = 11)
or ((sf.institution_id = ? or sf.institution_id = '0') and (sf.level_id = ? or sf.level_id = '0') and sal.id = 12)
      )    
WHERE sf.active = 1 and sf.fee_type_id=? and sf.institution_id = ? limit 1"
                    ,[
                        $j_regno,
                        $regno,
                        $field_id,
                        $field_id,$level_id,
                        $department_id,
                        $department_id,$level_id,
                        $faculty_id,
                        $faculty_id,$level_id,
                        $programme_id,
                        $programme_id,$level_id,
                        $institution_id,
                        $institution_id,$level_id,
                        $fee_type_id,$institution_id
                    ]
                );
                if(count($fee)){
                    $fee_application_level_id = $fee[0]->application_level_id;
                    $fee_type_id = $fee[0]->fee_type_id;
                    $is_one_off = $fee[0]->is_one_off;
                    if($is_one_off){
                        $fee_detail = $fee[0];
                        if(!in_array($fee[0]->amount, array($TRANS_AMOUNT, $TRANS_AMOUNT + 100, $TRANS_AMOUNT - 10))){
                            return array('success' => false, 'message' => "Payment confirmation failed: invalid fee amount paid!", 'data' => []);
                        }
                    }else{
                        $fee_detail = Fee::where(array(
                            ['application_level_id', $fee_application_level_id],
                            ['fee_type_id', $fee_type_id],
                            ['institution_id', $institution_id],
                            ['active', 1]
                        ))->whereIn('amount', array($TRANS_AMOUNT, $TRANS_AMOUNT + 100, $TRANS_AMOUNT - 10))->first();
                        if(!$fee_detail){
                            return array('success' => false, 'message' => "Payment confirmation failed: invalid fee amount paid!", 'data' => []);
                        }
                    }
                    if($fee_detail){
                        $data = [
                            [
                                'fee_id' => $fee_type_id,
                                'payment_type_id' => $fee_detail->payment_type_id,
                                'institution_id' =>$institution_id,
                                'level_id' => $level_id,
                                'j_regno' => $j_regno,
                                'regno' => $regno,
                                'amount' => $fee_detail->amount,
                                'confirmation_no' => $CONFIRMATION_NO,
                                'receipt_no' => $RECEIPT_NO,
                                'terminal_id' => $TERMINAL_ID,
                                'payment_code' => $PAYMENT_CODE,
                                'merchant_code' => $MERCHANT_CODE,
                                'payment_date' => $TRANS_DATE,
                                'payment_description' => $TRANS_DESCR,
                                'cbn_code' => $BANK_CODE,
                                'bank_name' => $BANK_NAME,
                                'bank_branch' => $BRANCH_NAME,
                                'lead_bank_code' => $LEAD_BANK_CODE,
                                'lead_bank_name' => $LEAD_BANK_NAME,
                                'customer_name' => $CUSTOMER_NAME,
                                'teller_id' => $TELLER_ID,
                                'payment_method' => $PAYMENT_METHOD_NAME,
                                'payment_currency' => $PAYMENT_CURRENCY,
                                'transaction_type' => $TRANS_TYPE,
                                'payment_fee_type' => $TYPE_NAME
                            ]
                        ];
                        Payment::insertIgnore($data); return array('success' => true, 'message' => 'Payment confirmed', 'data' => []);
                    }
                }else{
                    return array('success' => false, 'message' => "Payment confirmation failed: Fee type not found!", 'data' => []);
                }
            }else{
                return array('success' => false, 'message' => "Payment confirmation failed: fee record not found!", 'data' => []);
            }
        }else{
            return array('success' => false, 'message' => "Payment confirmation failed: User record not found!", 'data' => []);
        }
    }

    public static function confirmPayment($main)
    {
        if(!empty($main)){
            if(auth()->user()->user_type == 'applicant'){
                if(auth()->user()->j_regno != $main['CUSTOMER_ID']){
                    return array('success' => false, 'message' => "Payment confirmation failed: Logged User is not same as Payment User!", 'data' => []);
                }
                if(Payment::where('confirmation_no', $main['CONFIRMATION_NO'])->first()){
                    return array('success' => false, 'message' => "Payment confirmation failed: Confirmation pin already used!", 'data' => []);
                }
                return self::confirmApplicantPayment($main);

            }elseif(auth()->user()->user_type == 'student'){
                if(auth()->user()->regno != $main['CUSTOMER_ID']){
                    return array('success' => false, 'message' => "Payment confirmation failed: Logged User is not same as Payment User!", 'data' => []);
                }
                if(Payment::where('confirmation_no', $main['CONFIRMATION_NO'])->first()){
                    return array('success' => false, 'message' => "Payment confirmation failed: Confirmation pin already used!", 'data' => []);
                }
                return self::confirmStudentPayment($main);

            }elseif(auth()->user()->user_type == 'admin'){
                if($main['USER'] != $main['CUSTOMER_ID']){
                    return array('success' => false, 'message' => "Payment confirmation failed: Logged User is not same as Payment User!", 'data' => []);
                }
                if(Payment::where('confirmation_no', $main['CONFIRMATION_NO'])->first()){
                    return array('success' => false, 'message' => "Payment confirmation failed: Confirmation pin already used!", 'data' => []);
                }
                if(!empty($main['USER'])){
                    if($main['USER_TYPE'] == 'student') return self::confirmStudentPayment($main);
                    elseif($main['USER_TYPE'] == 'applicant') return self::confirmApplicantPayment($main);

                }else{
                    return array('success' => false, 'message' => "Payment confirmation failed: User not provided!", 'data' => []);
                }
            }
        }else{
            return array('success' => false, 'message' => "Payment confirmation failed: invalid response from switching service!", 'data' => []);
        }
    }



}
