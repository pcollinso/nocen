<?php
namespace App\Http\Controllers\Admin;
use Validator;
use App\Http\Controllers\Controller;
use App\Models\Field;

class FieldController extends Controller
{
  public function index()
  {
    $institution = auth()->user()
      ->institution()
      ->first()
      ->load('faculties', 'programmes', 'departments', 'fields');

    return view('fields.list', [
      'institution' => $institution
    ]);
  }

  public function update($id)
  {
    $data = $this->request->all();
    $validator = Validator::make($data, [
      'institution_id' => 'exists:sup_institution,id',
      'programme_id' => 'exists:sch_programme,id',
      'faculty_id' => 'exists:sch_faculty,id',
      'department_id' => 'exists:sch_department,id',
    ]);
    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'data' => $validator->errors()->messages()
        ], 422);
    }

    Field::unguard();
    $field = Field::find($id)->fill($data);
    Field::reguard();
    if ($field->isDuplicate())
    {
      return response()->json([
          'success' => false,
          'message' => 'Field is duplicate',
          'data' => []
      ], 422);
    }
    $field->save();

    return response()->json([
        'success' => true,
        'message' => 'Field updated',
        'data' => $field
    ]);
  }

  public function create()
  {
    $data = $this->request->all();
    $validator = Validator::make($data, [
      'institution_id' => 'required|exists:sup_institution,id',
      'programme_id' => 'required|exists:sch_programme,id',
      'faculty_id' => 'required|exists:sch_faculty,id',
      'department_id' => 'required|exists:sch_department,id',
    ]);
    if ($validator->fails()) {
      return response()->json([
        'success' => false,
        'message' => 'Validation failed',
        'data' => $validator->errors()->messages()
      ], 422);
    }

    Field::unguard();
    $field = new Field($data);
    Field::reguard();
    if ($field->isDuplicate())
    {
      return response()->json([
          'success' => false,
          'message' => 'Field is duplicate',
          'data' => []
      ], 422);
    }
    $field->save();

    return response()->json([
        'success' => true,
        'message' => 'Field created',
        'data' => $field
    ]);
  }

  public function delete($id)
  {
    $success = (bool) Field::destroy($id);
    return response()->json([
      'success' => $success,
      'message' => $success ? 'Field deleted' : 'Could not delete field'
  ]);
  }
}
