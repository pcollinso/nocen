<?php

namespace App\Http\Controllers\Applicant;

use Auth;
use Route;
use Validator;
use App\Http\Controllers\Controller;
use App\Utils\Passcode;
use App\Models\Programme;
use App\Models\Applicant;

class LoginController extends Controller
{

    public function createApplicant()
    {
      $data = $this->request->all();
      $validator = Validator::make($data, [
        'institution_id' => 'required|exists:sup_institution,id',
        'field_id' => 'required|exists:sch_field,id',
        'phone' => 'required|regex:/^\d{7,11}$/',
        'email' => 'required|email|max:200'
      ]);

      if ($validator->fails()) {
        return response()->json([
          'success' => false,
          'message' => 'Validation failed',
          'data' => $validator->errors()->messages()
        ], 422);
      }

      if (Applicant::phoneExists($data['institution_id'], $data['phone']))
      {
        return response()->json([
          'success' => false,
          'message' => 'Phone number has been used',
          'data' => (object) []
        ], 422);
      }

      if (Applicant::emailExists($data['institution_id'], $data['email']))
      {
        return response()->json([
          'success' => false,
          'message' => 'Email address has been used',
          'data' => (object) []
        ], 422);
      }

      if (Applicant::regNoExists($data['institution_id'], $data['j_regno']))
      {
        return response()->json([
          'success' => false,
          'message' => 'JAMB reg. number has been used',
          'data' => (object) []
        ], 422);
      }

      unset($data['token']);
      $data['user_password'] = Passcode::hashPassword($data['user_password']);
      $data['active'] = 1;

      $applicant = Applicant::createApplicant($data);

      return response()->json([
        'success' => (bool) $applicant,
        'message' => 'Created successfully',
        'data' => $applicant
      ]);
    }

    public function showRegister()
    {
      $programmes = Programme::all()->load('faculties', 'faculties.departments', 'faculties.departments.fields');

      return view('applicant.register', ['programmes' => $programmes]);
    }
}
