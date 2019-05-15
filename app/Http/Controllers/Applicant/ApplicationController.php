<?php
namespace App\Http\Controllers\Applicant;

use Validator;
use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\Country;
use App\Models\Gender;
use App\Models\Lga;
use App\Models\Religion;
use App\Models\State;
use App\Models\NextOfKin;

class ApplicationController extends Controller
{
  public function index()
  {
    $applicant = auth()->user()->load('nextOfKins', 'nextOfKins.relationship', 'nextOfKins.gender');
    $genders = Gender::all();
    $countries = Country::all();
    $states = State::all();
    $lgas = Lga::all();
    $religions = Religion::all();

    return view('applicant.home', [
      'applicant' => $applicant,
      'genders' => $genders,
      'countries' => $countries,
      'states' => $states,
      'lgas' => $lgas,
      'religions' => $religions,
      'pageTitle' => 'Application'
    ]);
  }

  public function updateApplicant($id)
  {
    $data = $this->request->except(['institution_id', 'field_id', 'phone', 'email', 'user_password', 'j_regno']);

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

    if (empty($data['nok_middle_name'])) unset($data['nok_middle_name']);

    $data['application_id'] = auth()->user()->id;

    $validator = Validator::make($data, [
      'nok_surname' => 'required|string',
      'nok_first_name' => 'required|string',
      'nok_middle_name' => 'string',
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
}
