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

class ApplicationController extends Controller
{
  public function index()
  {
    $applicant = auth()->user();
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
      'religion_id' => 'exists:sup_relationships,id',
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
}
