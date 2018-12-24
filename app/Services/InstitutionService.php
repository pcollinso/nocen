<?php

namespace App\Services;
use App\Models\Institution;

class InstitutionService
{
  public function getAll()
  {
    return Institution::all()->all();
  }

  public function getById($id)
  {
    return Institution::find($id);
  }

  public function getByCode($code)
  {
    return Institution::where('institution_code', $code)->first();
  }

  public function getByName($name)
  {
    return Institution::where('institution_name', $name)->first();
  }
}
