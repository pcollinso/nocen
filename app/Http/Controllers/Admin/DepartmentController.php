<?php
namespace App\Http\Controllers\Admin;
use Validator;
use App\Http\Controllers\Controller;
use App\Models\Department;

class DepartmentController extends Controller
{
  public function index()
  {
    $institution = auth()->user()
      ->institution()
      ->first()
      ->load('faculties', 'programmes', 'departments');

    return view('departments.list', [
      'institution' => $institution
    ]);
  }

  public function update($id)
  {
    $data = $this->request->all();
    $validator = Validator::make($data, [
      'institution_id' => 'exists:sup_institution,id',
      'programme_id' => 'exists:sch_programme,id',
      'faculty_id' => 'required|exists:sch_faculty,id'
    ]);
    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'data' => $validator->errors()->messages()
        ], 422);
    }

    Department::unguard();
    $department = Department::find($id)->fill($data);
    Department::reguard();
    if ($department->isDuplicate())
    {
      return response()->json([
          'success' => false,
          'message' => 'Department is duplicate',
          'data' => []
      ], 422);
    }
    $department->save();

    return response()->json([
        'success' => true,
        'message' => 'Department updated',
        'data' => $department
    ]);
  }

  public function create()
  {
    $data = $this->request->all();
    $validator = Validator::make($data, [
      'institution_id' => 'required|exists:sup_institution,id',
      'programme_id' => 'required|exists:sch_programme,id',
      'faculty_id' => 'required|exists:sch_faculty,id'
    ]);
    if ($validator->fails()) {
      return response()->json([
        'success' => false,
        'message' => 'Validation failed',
        'data' => $validator->errors()->messages()
      ], 422);
    }

    Department::unguard();
    $department = new Department($data);
    Department::reguard();
    if ($department->isDuplicate())
    {
      return response()->json([
          'success' => false,
          'message' => 'Department is duplicate',
          'data' => []
      ], 422);
    }
    $department->save();

    return response()->json([
        'success' => true,
        'message' => 'Department created',
        'data' => $department
    ]);
  }

  public function delete($id)
  {
    $success = (bool) Department::destroy($id);
    return response()->json([
      'success' => $success,
      'message' => $success ? 'Department deleted' : 'Could not delete department'
  ]);
  }
}
