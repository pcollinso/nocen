<?php

namespace App\Services;
use App\Models\Course;

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
      ->where('course_code', strtoupper($attrs['course_code']))
      ->where('department_id', strtoupper($attrs['department_id']))
      ->where('faculty_id', strtoupper($attrs['faculty_id']))
      ->where('programme_id', strtoupper($attrs['programme_id']))
      ->where('institution_id', strtoupper($attrs['institution_id']))
      ->first();
    if ($existingCourse) return $existingCourse;
    Course::unguard();
    $course = Course::create($attrs);
    Course::reguard();
    return $course;
  }

}
