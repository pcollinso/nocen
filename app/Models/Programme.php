<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
  protected $table = 'sch_programme';

  public function institution()
  {
      return $this->belongsTo(Institution::class);
  }

  public function faculties()
  {
      return $this->hasMany(Faculty::class);
  }

  public function departments()
  {
      return $this->hasMany(Department::class);
  }

  public function fields()
  {
      return $this->hasMany(Field::class);
  }
}
