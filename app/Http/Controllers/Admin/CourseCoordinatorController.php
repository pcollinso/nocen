<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\CourseCoordinator;

class CourseCoordinatorController extends Controller
{
  public function index()
  {
    $institution = auth()->user()
      ->institution()
      ->first()
      ->load('staff', 'courses', 'course_coordinators');

    return view('course_coordinators.list', [ 'institution' => $institution ]);
  }

  public function update($id, Request $request)
  {
    $data = $request->all();
    $validator = Validator::make($data, [
      'institution_id' => 'exists:sup_institution,id',
      'staff_id' => 'exists:sch_staff,id',
      'course_id' => 'exists:sch_course,id',
      'status' => 'numeric'
    ]);
    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'data' => $validator->errors()->messages()
        ], 422);
    }

    CourseCoordinator::unguard();
    $courseCoordinator = CourseCoordinator::find($id)->fill($data);
    CourseCoordinator::reguard();
    if ($courseCoordinator->isDuplicate())
    {
      return response()->json([
          'success' => false,
          'message' => 'Course coordinator is duplicate',
          'data' => []
      ], 422);
    }
    $courseCoordinator->save();

    return response()->json([
        'success' => true,
        'message' => 'Course coordinator updated',
        'data' => $courseCoordinator
    ]);
  }

  public function create(Request $request)
  {
    $data = $request->all();
    $validator = Validator::make($data, [
      'institution_id' => 'required|exists:sup_institution,id',
      'staff_id' => 'required|exists:sch_staff,id',
      'course_id' => 'required|exists:sch_course,id',
      'status' => 'numeric'
    ]);
    if ($validator->fails()) {
      return response()->json([
        'success' => false,
        'message' => 'Validation failed',
        'data' => $validator->errors()->messages()
      ], 422);
    }

    CourseCoordinator::unguard();
    $courseCoordinator = new CourseCoordinator($data);
    CourseCoordinator::reguard();
    if ($courseCoordinator->isDuplicate())
    {
      return response()->json([
          'success' => false,
          'message' => 'Course coordinator is duplicate',
          'data' => []
      ], 422);
    }
    $courseCoordinator->save();

    return response()->json([
        'success' => true,
        'message' => 'Course coordinator created',
        'data' => $courseCoordinator
    ]);
  }

  public function delete($id)
  {
    $success = (bool) CourseCoordinator::destroy($id);
    return response()->json([
      'success' => $success,
      'message' => $success ? 'Course coordinator deleted' : 'Could not delete course coordinator'
  ]);
  }
}
