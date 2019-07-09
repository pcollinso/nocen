<?php
namespace App\Http\Controllers;

use App\Models\Payment;
use App\Utils\Utility;
use App\Models\Fee;
use App\Models\FeeType;
use App\Models\ApplicationLevel;
use App\Models\FeeCheckExclusion;
use App\Models\PaymentType;

class PaymentController extends Controller
{

    public function test()
    {
        $getImage = Utility::getConvertImage(array(
            'file_path' => "http%3A%2F%2Flocalhost%2Fcol%2Fassets%2Fimg%2Fuser-4.jpg",
            'width' => 300,
            'height' => 300,
            'format' => 'jpg',
            'save_path' => public_path('images/biometric/applicant/'.'86354555FF'.'.jpg'),
            'quality' => 60));dd($getImage);

        $output = urldecode("RECEIPT_NO=0701809211271298&PAYMENT_CODE=07025701271537524516111&MERCHANT_CODE=0701300039&TRANS_AMOUNT=1250.0&TRANS_DATE=2018/09/21 10:08:48&TRANS_DESCR=APPLICATION_FEE-86354555FF-OKEZIE%20CHIDIMMA&CUSTOMER_ID=86354555FF&BANK_CODE=070&BRANCH_CODE=130&SERVICE_ID=86354555FF&CUSTOMER_NAME=OKEZIE%20CHIDIMMA&CUSTOMER_ADDRESS=.&TELLER_ID=Ma.Okeke&USERNAME=N/A&PASSWORD=N/A&BANK_NAME=Fidelity%20Bank&BRANCH_NAME=NSUGBE%20BRANCH&CHANNEL_NAME=Bank&PAYMENT_METHOD_NAME=Cash&PAYMENT_CURRENCY=566&TRANS_TYPE=FULL_PAYMENT&TRANS_FEE=0.0&TYPE_NAME=APPLICATION_FEE&LEAD_BANK_CODE=070&LEAD_BANK_NAME=Fidelity%20Bank");
        if(!empty($output)) {
            $arr = explode('&', $output);
            foreach ($arr as $r) {
                $arr1 = explode('=', $r);
                $main[$arr1[0]] = $arr1[1];
            }
            $main['INPUT_CONFIRMATION_NO'] = "07025701271537524516863";
            $main['INPUT_TERMINAL_ID'] = "7009158828";

            if (!empty($main['TRANS_AMOUNT'])) {
                $c = self::confirmPayment($main);
                if (!isset($c['error'])) {
                    // proceed to other things

                }
            }
        }
    }

    public static function confirmPayment($main)
    {
        dd(auth()->user()->user_type);
        $error = array();
        if(!empty($main)){
            $TRANS_AMOUNT = isset($main['TRANS_AMOUNT'])?$main['TRANS_AMOUNT']:''; // amount
            $RECEIPT_NO = isset($main['RECEIPT_NO'])?$main['RECEIPT_NO']:''; // receipt_no
            $PAYMENT_CODE = isset($main['PAYMENT_CODE'])?$main['PAYMENT_CODE']:''; // payment_code
            $MERCHANT_CODE = isset($main['MERCHANT_CODE'])?$main['MERCHANT_CODE']:''; // merchant_code
            $TRANS_DATE = isset($main['TRANS_DATE'])?$main['TRANS_DATE']:''; // payment_date
            $TRANS_DESCR = isset($main['TRANS_DESCR'])?$main['TRANS_DESCR']:''; // payment_description
            $CUSTOMER_ID = isset($main['CUSTOMER_ID'])?$main['CUSTOMER_ID']:''; // regno or j_regno
            $BANK_CODE = isset($main['BANK_CODE'])?$main['BANK_CODE']:''; // cbn_code
            $CUSTOMER_NAME = isset($main['CUSTOMER_NAME'])?$main['CUSTOMER_NAME']:''; // customer_name
            $TELLER_ID = isset($main['TELLER_ID'])?$main['TELLER_ID']:''; // teller_id
            $BANK_NAME = isset($main['BANK_NAME'])?$main['BANK_NAME']:''; // bank_name
            $BRANCH_NAME = isset($main['BRANCH_NAME'])?$main['BRANCH_NAME']:''; // bank_branch
            $PAYMENT_METHOD_NAME = isset($main['PAYMENT_METHOD_NAME'])?$main['PAYMENT_METHOD_NAME']:''; // payment_method
            $PAYMENT_CURRENCY = isset($main['PAYMENT_CURRENCY'])?$main['PAYMENT_CURRENCY']:''; // payment_currency
            $TYPE_NAME = isset($main['TYPE_NAME'])?$main['TYPE_NAME']:''; // payment_fee_type
            $TRANS_TYPE = isset($main['TRANS_TYPE'])?$main['TRANS_TYPE']:''; //  transaction_type
            $LEAD_BANK_CODE = isset($main['LEAD_BANK_CODE'])?$main['LEAD_BANK_CODE']:''; // lead_bank_code
            $LEAD_BANK_NAME = isset($main['LEAD_BANK_NAME'])?$main['LEAD_BANK_NAME']:''; // lead_bank_name
            $CONFIRMATION_NO = isset($main['CONFIRMATION_NO'])?$main['CONFIRMATION_NO']:''; // confirmation_no
            $TERMINAL_ID = isset($main['TERMINAL_ID'])?$main['TERMINAL_ID']:''; // terminal_id

            $payment_type = PaymentType::where('payment_type', $main['TRANS_TYPE'])->first();
            if(!$payment_type) $error[] = "Payment type not found!"; else $payment_type_id = $payment_type->id;

            $fee_type = FeeType::where('fee_type', $main['TYPE_NAME'])->first();
            if(!$fee_type) $error[] = "Fee type not found!"; else $fee_type_id = $fee_type->id;

            $institution_id = auth()->user()->institution_id;

            dd($fee_type_id);
        }else{
            $error[] = "Fee check failed: invalid response from switching service";
        }
        return array(
            'success' => empty($error) ? true : false,
            'message' => Utility::parseErrorArray($error),
            'data' => []
        );
    }



}
