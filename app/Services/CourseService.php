<?php

namespace App\Services;
use App\Models\Course;
use App\Models\CoursePrerequisite;

class CourseService
{
  public function getAll()
  {
    return Course::all()->all();
  }

  public function getById($id)
  {
    return Course::find($id);
  }

  public function getByInstitution($id)
  {
    return Course::where('institution_id', $id)->get()->all();
  }

  public function getByProgramme($id)
  {
    return Course::where('programme_id', $id)->get()->all();
  }

  public function getByFaculty($id)
  {
    return Course::where('faculty_id', $id)->get()->all();
  }

  public function getByDepartment($id)
  {
    return Course::where('department_id', $id)->get()->all();
  }

  public function create($attrs)
  {
    $attrs['course_name'] = strtoupper($attrs['course_name']);
    $existingCourse = Course::where('course_name', $attrs['course_name'])
      ->where('course_code', $attrs['course_code'])
      ->where('department_id', $attrs['department_id'])
      ->where('faculty_id', $attrs['faculty_id'])
      ->where('programme_id', $attrs['programme_id'])
      ->where('institution_id', $attrs['institution_id'])
      ->first();
    if ($existingCourse) return $existingCourse;
    Course::unguard();
    $course = Course::create($attrs);
    Course::reguard();
    return $course;
  }

  public function getAllPrerequisites()
  {
    return CoursePrerequisite::all()->all();
  }

  public function getPrerequisiteById($id)
  {
    return CoursePrerequisite::find($id);
  }

  public function getPrerequisitesByInstitution($id)
  {
    return CoursePrerequisite::where('institution_id', $id)->get()->all();
  }

  public function getPrerequisitesByCourse($id)
  {
    return CoursePrerequisite::where('course_id', $id)->get()->all();
  }

  public function createPrerequisite($attrs)
  {
    $existingCoursePrereq = CoursePrerequisite::where('institution_id', $attrs['institution_id'])
      ->where('course_id', $attrs['course_id'])
      ->where('require_course_id', $attrs['require_course_id'])
      ->first();
    if ($existingCoursePrereq) return $existingCoursePrereq;
    CoursePrerequisite::unguard();
    $prereq = CoursePrerequisite::create($attrs);
    CoursePrerequisite::reguard();
    return $prereq;
  }

}
