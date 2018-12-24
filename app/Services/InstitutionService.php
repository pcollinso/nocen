<?php

namespace App\Services;
use App\Models\Institution;

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
}
