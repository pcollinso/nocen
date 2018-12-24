<?php

namespace App\Services;
use App\Models\Institution;
use App\Models\Programme;
use App\Models\Faculty;
use App\Models\Department;

class InstitutionService
{
  public function getInstitutions()
  {
    return Institution::all()->all();
  }

  public function getInstitutionById($id)
  {
    return Institution::find($id);
  }

  public function getInstitutionByCode($code)
  {
    return Institution::where('institution_code', $code)->first();
  }

  public function getInstitutionByName($name)
  {
    return Institution::where('institution_name', $name)->first();
  }

  public function getProgrammes()
  {
    return Programme::all()->all();
  }

  public function getProgrammeById($id)
  {
    return Programme::find($id);
  }

  public function getProgrammeByInstitutionAndName($id, $name)
  {
    return Programme::where('institution_id', $id)->where('programme_name', $name)->first();
  }

  public function createProgramme($attrs)
  {
    $existingProgramme = $this->getProgrammeByInstitutionAndName($attrs['institution_id'], $attrs['programme_name']);
    if ($existingProgramme) return $existingProgramme;

    Programme::unguard();
    $programme = Programme::create($attrs);
    Programme::reguard();
    return $programme;
  }

  public function getFaculties()
  {
    return Faculty::all()->all();
  }

  public function getFacultiesByInstitution($id)
  {
    return Faculty::where('institution_id', $id)->get()->all();
  }

  public function getFacultiesByProgramme($id)
  {
    return Faculty::where('programme_id', $id)->get()->all();
  }

  public function getFacultyById($id)
  {
    return Faculty::find($id);
  }

  public function getDepartments()
  {
    return Department::all()->all();
  }

  public function getDepartmentsByInstitution($id)
  {
    return Department::where('institution_id', $id)->get()->all();
  }

  public function getDepartmentsByProgramme($id)
  {
    return Department::where('programme_id', $id)->get()->all();
  }

  public function getDepartmentsByFaculty($id)
  {
    return Department::where('faculty_id', $id)->get()->all();
  }

  public function getDepartmentById($id)
  {
    return Department::find($id);
  }

  public function createDepartment($attrs)
  {
    $existingDept = Department::where('department_name', strtoupper($attrs['department_name']))
      ->where('faculty_id', strtoupper($attrs['faculty_id']))
      ->where('programme_id', strtoupper($attrs['programme_id']))
      ->where('institution_id', strtoupper($attrs['institution_id']))
      ->first();
    if ($existingDept) return $existingDept;

    Department::unguard();
    $dept = Department::create($attrs);
    Department::reguard();
    return $dept;
  }
}
