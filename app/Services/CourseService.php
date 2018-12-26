<?php

namespace App\Services;
use App\Models\Course;
use App\Models\CoursePrerequisite;
use App\Models\GeneralCourse;
use App\Models\StaffCourse;

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

  public function getAllGeneralCourses()
  {
    return GeneralCourse::all()->all();
  }

  public function getGeneralCourseById($id)
  {
    return GeneralCourse::find($id);
  }

  public function getGeneralCoursesByInstitution($id)
  {
    return GeneralCourse::where('institution_id', $id)->get()->all();
  }

  public function getGeneralCoursesByDepartment($id)
  {
    return GeneralCourse::where('department_id', $id)->get()->all();
  }

  public function createGeneralCourse($attrs)
  {
    $existingGenCourse = GeneralCourse::where('institution_id', $attrs['institution_id'])
      ->where('course_id', $attrs['course_id'])
      ->where('department_id', $attrs['department_id'])
      ->where('level_id', $attrs['level_id'])
      ->where('semester_id', $attrs['semester_id'])
      ->first();
    if ($existingGenCourse) return $existingGenCourse;
    GeneralCourse::unguard();
    $genCourse = GeneralCourse::create($attrs);
    GeneralCourse::reguard();
    return $genCourse;
  }

  public function getAllStaffCourses()
  {
    return StaffCourse::all()->all();
  }

  public function getStaffCourseById($id)
  {
    return StaffCourse::find($id);
  }

  public function getStaffCoursesByInstitution($id)
  {
    return StaffCourse::where('institution_id', $id)->get()->all();
  }

  public function getStaffCoursesByStaff($id)
  {
    return StaffCourse::where('staff_id', $id)->get()->all();
  }

  public function createStaffCourse($attrs)
  {
    $existingStaffCourse = StaffCourse::where('institution_id', $attrs['institution_id'])
      ->where('course_id', $attrs['course_id'])
      ->where('staff_id', $attrs['staff_id'])
      ->first();
    if ($existingStaffCourse) return $existingStaffCourse;
    StaffCourse::unguard();
    $staffCourse = StaffCourse::create($attrs);
    StaffCourse::reguard();
    return $staffCourse;
  }

}
