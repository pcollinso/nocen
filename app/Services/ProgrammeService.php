<?php

namespace App\Services;
use App\Models\Programme;

class ProgrammeService
{
  public function getAll()
  {
    return Programme::all()->all();
  }

  public function getById($id)
  {
    return Programme::find($id);
  }

  public function getByInstitutionAndName($id, $name)
  {
    return Programme::where('institution_id', $id)->where('programme_name', $name)->first();
  }

  public function create($attrs)
  {
    $existingProgramme = $this->getByInstitutionAndName($attrs['institution_id'], $attrs['programme_name']);
    if ($existingProgramme) return $existingProgramme;

    Programme::unguard();
    $programme = Programme::create($attrs);
    Programme::reguard();
    return $programme;
  }
}
