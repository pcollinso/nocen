<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\CoursePrerequisite;

class CoursePrerequisiteController extends Controller
{
  public function index()
  {
    $institution = auth()->user()
      ->institution()
      ->first()
      ->load('courses', 'course_prerequisites');

    return view('course_prerequisites.list', [ 'institution' => $institution ]);
  }

  public function update($id, Request $request)
  {
    $data = $request->all();
    $validator = Validator::make($data, [
      'institution_id' => 'exists:sup_institution,id',
      'course_id' => 'exists:sch_course,id'
    ]);
    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'data' => $validator->errors()->messages()
        ], 422);
    }

    CoursePrerequisite::unguard();
    $coursePrerequisite = CoursePrerequisite::find($id)->fill($data);
    CoursePrerequisite::reguard();
    if ($coursePrerequisite->isDuplicate())
    {
      return response()->json([
          'success' => false,
          'message' => 'Course prerequisite is duplicate',
          'data' => []
      ], 422);
    }
    $coursePrerequisite->save();

    return response()->json([
        'success' => true,
        'message' => 'Course prerequisite updated',
        'data' => $coursePrerequisite
    ]);
  }

  public function create(Request $request)
  {
    $data = $request->all();
    $validator = Validator::make($data, [
      'institution_id' => 'required|exists:sup_institution,id',
      'course_id' => 'required|exists:sch_course,id'
    ]);
    if ($validator->fails()) {
      return response()->json([
        'success' => false,
        'message' => 'Validation failed',
        'data' => $validator->errors()->messages()
      ], 422);
    }

    CoursePrerequisite::unguard();
    $coursePrerequisite = new CoursePrerequisite($data);
    CoursePrerequisite::reguard();
    if ($coursePrerequisite->isDuplicate())
    {
      return response()->json([
          'success' => false,
          'message' => 'Course prerequisite is duplicate',
          'data' => []
      ], 422);
    }
    $coursePrerequisite->save();

    return response()->json([
        'success' => true,
        'message' => 'Course prerequisite created',
        'data' => $coursePrerequisite
    ]);
  }

  public function delete($id)
  {
    $success = (bool) CoursePrerequisite::destroy($id);
    return response()->json([
      'success' => $success,
      'message' => $success ? 'Course prerequisite deleted' : 'Could not delete course prerequisite'
  ]);
  }
}
