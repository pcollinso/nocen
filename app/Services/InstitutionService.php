<?php

namespace App\Services;
use App\Models\Institution;
use App\Models\Programme;

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
}
