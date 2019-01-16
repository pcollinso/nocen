<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class InstitutionType extends Model
{
  protected $table = 'sch_institution_type';
  public $timestamps = false;

  public function institutions()
  {
      return $this->hasMany(Institution::class);
  }
}
