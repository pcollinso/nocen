<?php

namespace App\Services;
use App\Models\GradeA;

class GradeAService
{
  public function getAll()
  {
    return GradeA::all()->all();
  }

  public function getById($id)
  {
    return GradeA::find($id);
  }

  public function getByName($name)
  {
    return GradeA::where('grade_name', $name)->first();
  }

  public function create($attrs)
  {
    $existingGradeA = $this->getByName(strtoupper($attrs['grade_name']));
    if ($existingGradeA) return $existingGradeA;
    GradeA::unguard();
    $gradeA = GradeA::create($attrs);
    GradeA::reguard();
    return $gradeA;
  }

}
