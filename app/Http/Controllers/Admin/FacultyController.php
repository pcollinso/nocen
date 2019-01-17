<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\Course;
use App\Models\Level;
use App\Models\Semester;

class CourseController extends Controller
{
  public function index()
  {
    $institution = auth()->user()
      ->institution()
      ->first()
      ->load('programmes', 'faculties', 'departments', 'courses');

    return view('courses.list', [
      'institution' => $institution,
      'levels' => Level::all(),
      'semesters' => Semester::all(),
    ]);
  }

  public function update($id, Request $request)
  {
    $data = $request->all();
    $validator = Validator::make($data, [
      'institution_id' => 'exists:sup_institution,id',
      'programme_id' => 'exists:sch_programme,id',
      'faculty_id' => 'exists:sch_faculty,id',
      'department_id' => 'exists:sch_department,id',
      'level_id' => 'exists:sch_level,id',
      'semester_id' => 'exists:sch_semester,id',
      'course_name' => 'string|max:200',
      'course_code' => 'string|max:30',
      'unit_load' => 'numeric',
      'is_general' => 'boolean'
    ]);
    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'data' => $validator->errors()->messages()
        ], 422);
    }

    Course::unguard();
    $course = Course::find($id)->fill($data);
    Course::reguard();
    if ($course->isDuplicate())
    {
      return response()->json([
          'success' => false,
          'message' => 'Course is duplicate',
          'data' => []
      ], 422);
    }
    $course->save();

    return response()->json([
        'success' => true,
        'message' => 'Course updated',
        'data' => $course
    ]);
  }

  public function create(Request $request)
  {
    $data = $request->all();
    $validator = Validator::make($data, [
      'institution_id' => 'required|exists:sup_institution,id',
      'programme_id' => 'required|exists:sch_programme,id',
      'faculty_id' => 'required|exists:sch_faculty,id',
      'department_id' => 'required|exists:sch_department,id',
      'level_id' => 'required|exists:sch_level,id',
      'semester_id' => 'required|exists:sch_semester,id',
      'course_name' => 'required|string|max:200',
      'course_code' => 'required|string|max:30',
      'unit_load' => 'required|numeric',
      'is_general' => 'required|boolean'
    ]);
    if ($validator->fails()) {
      return response()->json([
        'success' => false,
        'message' => 'Validation failed',
        'data' => $validator->errors()->messages()
      ], 422);
    }

    Course::unguard();
    $course = new Course($data);
    Course::reguard();
    if ($course->isDuplicate())
    {
      return response()->json([
          'success' => false,
          'message' => 'Course is duplicate',
          'data' => []
      ], 422);
    }
    $course->save();

    return response()->json([
        'success' => true,
        'message' => 'Course created',
        'data' => $course
    ]);
  }

  public function delete($id)
  {
    $success = (bool) Course::destroy($id);
    return response()->json([
      'success' => $success,
      'message' => $success ? 'Course deleted' : 'Could not delete course'
  ]);
  }
}
