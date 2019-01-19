<?php
namespace App\Http\Controllers\Admin;
use Validator;
use App\Http\Controllers\Controller;
use App\Models\Faculty;

class FacultyController extends Controller
{
  public function index()
  {
    $institution = auth()->user()
      ->institution()
      ->first()
      ->load('faculties', 'programmes');

    return view('faculties.list', [
      'institution' => $institution
    ]);
  }

  public function update($id)
  {
    $data = $this->request->all();
    $validator = Validator::make($data, [
      'institution_id' => 'exists:sup_institution,id',
      'programme_id' => 'exists:sch_programme,id'
    ]);
    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'data' => $validator->errors()->messages()
        ], 422);
    }

    Faculty::unguard();
    $faculty = Faculty::find($id)->fill($data);
    Faculty::reguard();
    if ($faculty->isDuplicate())
    {
      return response()->json([
          'success' => false,
          'message' => 'Faculty is duplicate',
          'data' => []
      ], 422);
    }
    $faculty->save();

    return response()->json([
        'success' => true,
        'message' => 'Faculty updated',
        'data' => $faculty
    ]);
  }

  public function create()
  {
    $data = $this->request->all();
    $validator = Validator::make($data, [
      'institution_id' => 'required|exists:sup_institution,id',
      'programme_id' => 'required|exists:sch_programme,id'
    ]);
    if ($validator->fails()) {
      return response()->json([
        'success' => false,
        'message' => 'Validation failed',
        'data' => $validator->errors()->messages()
      ], 422);
    }

    Faculty::unguard();
    $faculty = new Faculty($data);
    Faculty::reguard();
    if ($faculty->isDuplicate())
    {
      return response()->json([
          'success' => false,
          'message' => 'Faculty is duplicate',
          'data' => []
      ], 422);
    }
    $faculty->save();

    return response()->json([
        'success' => true,
        'message' => 'Faculty created',
        'data' => $faculty
    ]);
  }

  public function delete($id)
  {
    $success = (bool) Faculty::destroy($id);
    return response()->json([
      'success' => $success,
      'message' => $success ? 'Faculty deleted' : 'Could not delete faculty'
  ]);
  }
}
