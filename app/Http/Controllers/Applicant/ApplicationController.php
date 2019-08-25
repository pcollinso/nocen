<?php
namespace App\Http\Controllers\Applicant;

use Validator;
use Storage;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\EtranzactClient;
use App\Utils\PaymentConfirmation;
use App\Models\Applicant;
use App\Models\Admission;
use App\Models\Country;
use App\Models\Gender;
use App\Models\Lga;
use App\Models\Religion;
use App\Models\State;
use App\Models\NextOfKin;
use App\Models\OlevelQualification;
use App\Models\OlevelResult;
use App\Models\UtmeResult;
use App\Models\OlevelGrade;
use App\Models\Subject;
use App\Models\Payment;

class ApplicationController extends Controller
{
  public function index()
  {
    $applicant = auth()
      ->user()
      ->load(
        'nextOfKins.relationship',
        'nextOfKins.gender',
        'olevelResults.examType',
        'utme',
        'admission',
        'institution',
        'field.programme'
      );

    $genders = Gender::all();
    $countries = Country::all();
    $states = State::all();
    $lgas = Lga::all();
    $religions = Religion::all();
    $olevels = OlevelQualification::all();

    return view('applicant.home', [
      'applicant' => $applicant,
      'genders' => $genders,
      'countries' => $countries,
      'states' => $states,
      'lgas' => $lgas,
      'religions' => $religions,
      'olevels' => $olevels,
      'pageTitle' => 'Application'
    ]);
  }

  public function printBiodata()
  {
    $applicant = auth()
      ->user()
      ->load(
        'nextOfKins.relationship',
        'nextOfKins.gender',
        'olevelResults.examType',
        'utme',
        'admission',
        'institution',
        'field.programme'
      );

    if (! $applicant->acceptance_fee) abort(403);

    $latestYear = array_reduce($applicant->olevelResults->all(), function ($year, $result) {
      return $result->year > $year ? $result->year : $year;
    }, 0);

    return view('applicant.biodata', [
      'latestYear' => $latestYear,
      'applicant' => $applicant,
      'pageTitle' => "$applicant->full_name | Biodata"
    ]);
  }

  public function printAcceptanceLetter($id)
  {
    $applicant = Applicant::find($id)->load('admission', 'field.programme');

    if (! $applicant->admission->admitted) abort(403);

    return view('applicant.acceptance-letter', [
      'applicant' => $applicant,
      'pageTitle' => "$applicant->full_name | Acceptance letter"
    ]);
  }

  public function printAdmissionLetter($id)
  {
    $applicant = Applicant::find($id)->load('admission', 'field.programme');

    if (! $applicant->admission->admitted) abort(403);

    return view('applicant.admission-letter', [
      'applicant' => $applicant,
      'pageTitle' => "$applicant->full_name | Admission letter"
    ]);
  }

  public function printProvisionalClearance($id)
  {
    $applicant = Applicant::find($id)
      ->load(
        'admission',
        'institution',
        'field.programme'
      );

    if (! $applicant->admission->admitted) abort(403);

    return view('applicant.provisional-clearance', [
      'applicant' => $applicant,
      'pageTitle' => "$applicant->full_name | Provisional clearance"
    ]);
  }

  public function printUndertaking($id)
  {
    $applicant = Applicant::find($id)
      ->load(
        'admission',
        'olevelResults.examType',
        'institution',
        'field.programme'
      );

    $subjects = array_reduce(Subject::all()->all(), function ($subArr, $s) {
      $subArr[$s->id] = $s->subject_name;
      return $subArr;
    }, []);
    $grades = array_reduce(OlevelGrade::all()->all(), function ($gradeArr, $g) {
      $gradeArr[$g->id] = $g->grade_name;
      return $gradeArr;
    }, []);

    if (! $applicant->admission->admitted) abort(403);

    return view('applicant.undertaking', [
      'grades' => $grades,
      'subjects' => $subjects,
      'applicant' => $applicant,
      'pageTitle' => "$applicant->full_name | Letter of undertaking"
    ]);
  }

  public function updateApplicant($id)
  {
    if (auth()->user()->hasPermissionTo('application:review'))
    {
      $except = ['institution_id', 'phone', 'email', 'user_password', 'j_regno'];
    } else
    {
      $except = ['institution_id', 'field_id', 'phone', 'email', 'user_password', 'j_regno'];
    }

    $data = $this->request->except($except);

    if (empty($data['middle_name'])) unset($data['middle_name']);

    $validator = Validator::make($data, [
      'surname' => 'required|string',
      'first_name' => 'required|string',
      'middle_name' => 'string',
      'dob' => 'regex:/^\d{4}-\d{2}-\d{2}$/',
      'nationality_id' => 'exists:sup_country,id',
      'religion_id' => 'exists:sch_religion,id',
      'state_id' => 'exists:sup_state,id',
      'gender_id' => 'exists:sch_gender,id',
      'lga_id' => 'exists:sup_lga,id',
      'town_id' => 'exists:sup_town,id'
    ]);

    if ($validator->fails()) {
      return response()->json([
        'success' => false,
        'message' => 'Validation failed',
        'data' => $validator->errors()->messages()
      ], 422);
    }

    $applicant = Applicant::find($id);
    $applicant->fill($data);
    $applicant->save();

    return response()->json([
        'success' => true,
        'message' => 'Applicant updated',
        'data' => $applicant
    ]);
  }

  public function addNextOfKin()
  {
    $data = $this->request->all();

    if (empty($data['middle_name'])) unset($data['middle_name']);

    $data['application_id'] = auth()->user()->id;

    $validator = Validator::make($data, [
      'surname' => 'required|string',
      'first_name' => 'required|string',
      'middle_name' => 'string',
      'institution_id' => 'exists:sup_institution,id',
      'nationality_id' => 'exists:sup_country,id',
      'relationship_id' => 'exists:sup_relationships,id',
      'gender_id' => 'exists:sch_gender,id',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'success' => false,
        'message' => 'Validation failed',
        'data' => $validator->errors()->messages()
      ], 422);
    }

    $nok = NextOfKin::create($data);
    $nok->loadMissing('gender', 'relationship');

    return response()->json([
        'success' => true,
        'message' => 'Next of kin added',
        'data' => $nok
    ]);
  }

  public function removeNextOfKin($id)
  {
    $deleted = NextOfKin::where('id', $id)->where('application_id', auth()->user()->id)->delete();

    if ($deleted)
    {
      return response()->json([
        'success' => true,
      ], 204);
    } else
    {
      return response()->json([
        'success' => false,
        'message' => 'Could not delete next of kin'
      ], 400);
    }
  }

  public function addOlevelResult()
  {
    $data = $this->request->all();

    $data['application_id'] = auth()->user()->id;

    $validator = Validator::make($data, [
      'institution_id' => 'exists:sup_institution,id',
      'application_id' => 'exists:sch_application_bio,id',
      'olevel_id' => 'exists:sch_olevel,id',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'success' => false,
        'message' => 'Validation failed',
        'data' => $validator->errors()->messages()
      ], 422);
    }

    return response()->json([
      'success' => true,
      'message' => 'Olevel result added',
      'data' => OlevelResult::create($data)->load('examType')
    ]);
  }

  public function removeOlevelResult($id)
  {
    $deleted = OlevelResult::where('id', $id)->where('application_id', auth()->user()->id)->delete();

    if ($deleted)
    {
      return response()->json([
        'success' => true,
      ], 204);
    } else
    {
      return response()->json([
        'success' => false,
        'message' => 'Could not delete Olevel result'
      ], 400);
    }
  }

  public function addUtmeResult()
  {
    $data = $this->request->all();

    $data['application_id'] = auth()->user()->id;

    $validator = Validator::make($data, [
      'institution_id' => 'exists:sup_institution,id',
      'application_id' => 'exists:sch_application_bio,id',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'success' => false,
        'message' => 'Validation failed',
        'data' => $validator->errors()->messages()
      ], 422);
    }

    return response()->json([
      'success' => true,
      'message' => 'UTME result added',
      'data' => UtmeResult::create($data)
    ]);
  }

  public function removeUtmeResult($id)
  {
    $deleted = UtmeResult::where('id', $id)->where('application_id', auth()->user()->id)->delete();

    if ($deleted)
    {
      return response()->json([
        'success' => true,
      ], 204);
    } else
    {
      return response()->json([
        'success' => false,
        'message' => 'Could not delete UTME result'
      ], 400);
    }
  }

  public function uploadPassport()
  {
    $applicant = auth()->user();

    // Delete previous passport if exists
    if (! empty($applicant->passport)) Storage::disk('public')->delete('passports/' . $applicant->passport);

    $path = Storage::disk('public')->put('passports', $this->request->file('passport'), 'public');

    $applicant->passport = str_ireplace('passports/', '', $path);
    $applicant->save();


    return response()->json([
      'success' => true,
      'message' => 'Passport uploaded',
      'path' => $applicant->passport
    ]);
  }

  public function listApplications()
  {
    return view('application.list', [
      'institution' => auth()->user()->institution->loadMissing('programmes', 'faculties', 'departments', 'fields'),
      'applications' => Applicant::getApplicationsForReview(),
      'subjects' => Subject::all()->toArray(),
      'grades' => OlevelGrade::all()->toArray(),
      'pageTitle' => 'Applications'
    ]);
  }

  public function saveAdmission()
  {
    $data = $this->request->all();

    $validator = Validator::make($data, [
      'total_post_utme_score' => 'required|numeric',
      'total_utme_score' => 'required|numeric',
      'admission_year' => 'required|integer',
      'post_utme_on' => 'required|date',
      'admitted_on' => 'required|date',
      'institution_id' => 'exists:sup_institution,id',
      'application_id' => 'exists:sch_application_bio,id',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'success' => false,
        'message' => 'Validation failed',
        'data' => $validator->errors()->messages()
      ], 422);
    }

    // Lock application
    Applicant::where('id', $data['application_id'])->update(['locked' => 1]);

    return response()->json([
      'success' => true,
      'message' => 'Admission created',
      'data' => Admission::create($data)
    ]);
  }

  public function confirmApplicationFee()
  {
    $data = $this->request->all();

    $applicant = auth()->user()->loadMissing('institution');

    $confirmationResult = $this->confirmFee($applicant, $data['confirmation_no'], 'APPLICATION_FEE');

    return response()->json($confirmationResult, $confirmationResult['success'] ? 200 : 400);
  }

  public function confirmResultFee()
  {
    $data = $this->request->all();

    $applicant = auth()->user()->loadMissing('institution');

    $confirmationResult = $this->confirmFee($applicant, $data['confirmation_no'], 'POST_UTME_RESULT_CHECK_FEE');

    return response()->json($confirmationResult, $confirmationResult['success'] ? 200 : 400);
  }

  public function confirmAcceptanceFee()
  {
    $data = $this->request->all();

    $applicant = auth()->user()->loadMissing('institution');

    $confirmationResult = $this->confirmFee($applicant, $data['confirmation_no'], 'ACCEPTANCE_FEE');

    return response()->json($confirmationResult, $confirmationResult['success'] ? 200 : 400);
  }

  private function confirmFee($applicant, $code, $fee)
  {
    $paymentResponse = EtranzactClient::getPayment($applicant->institution->terminal_id, $code);

    if (EtranzactClient::isErrorResponse($paymentResponse))
    {
      return response()->json([
        'success' => false,
        'message' => 'Payment record not found'
      ], 400);
    }

    ['success' => $success, 'message' => $msg, 'data' => $data] =
      PaymentConfirmation::confirmApplicationFee($applicant, $paymentResponse, $fee);

    return $success ?
      ['success' => $success, 'message' => $msg, 'payment' => $data] :
      ['success' => $success, 'message' => $msg];
  }
}
