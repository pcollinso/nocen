<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\CourseAdviser;
use App\Models\Level;

class CourseAdviserController extends Controller
{
  public function index()
  {
    $institution = auth()->user()
      ->institution()
      ->first()
      ->load('staff', 'departments', 'course_advisers');

    return view('course_advisers.list', [
      'levels' => Level::all(),
      'institution' => $institution,
    ]);
  }

  public function update($id, Request $request)
  {
    $data = $request->all();
    $validator = Validator::make($data, [
      'institution_id' => 'exists:sup_institution,id',
      'department_id' => 'exists:sch_department,id',
      'level_id' => 'exists:sch_level,id',
      'staff_id' => 'exists:sch_staff,id',
      'status' => 'numeric'
    ]);
    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'data' => $validator->errors()->messages()
        ], 422);
    }

    CourseAdviser::unguard();
    $courseAdviser = CourseAdviser::find($id)->fill($data);
    CourseAdviser::reguard();
    if ($courseAdviser->isDuplicate())
    {
      return response()->json([
          'success' => false,
          'message' => 'Course adviser is duplicate',
          'data' => []
      ], 422);
    }
    $courseAdviser->save();

    return response()->json([
        'success' => true,
        'message' => 'Course adviser updated',
        'data' => $courseAdviser
    ]);
  }

  public function create(Request $request)
  {
    $data = $request->all();
    $validator = Validator::make($data, [
      'institution_id' => 'required|exists:sup_institution,id',
      'department_id' => 'required|exists:sch_department,id',
      'level_id' => 'required|exists:sch_level,id',
      'staff_id' => 'required|exists:sch_staff,id',
      'status' => 'numeric'
    ]);
    if ($validator->fails()) {
      return response()->json([
        'success' => false,
        'message' => 'Validation failed',
        'data' => $validator->errors()->messages()
      ], 422);
    }

    CourseAdviser::unguard();
    $courseAdviser = new CourseAdviser($data);
    CourseAdviser::reguard();
    if ($courseAdviser->isDuplicate())
    {
      return response()->json([
          'success' => false,
          'message' => 'Course adviser is duplicate',
          'data' => []
      ], 422);
    }
    $courseAdviser->save();

    return response()->json([
        'success' => true,
        'message' => 'Course adviser created',
        'data' => $courseAdviser
    ]);
  }

  public function delete($id)
  {
    $success = (bool) CourseAdviser::destroy($id);
    return response()->json([
      'success' => $success,
      'message' => $success ? 'Course adviser deleted' : 'Could not delete course adviser'
  ]);
  }
}
