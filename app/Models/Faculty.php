<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
  protected $table = 'sch_faculty';

  public function institution()
  {
      return $this->belongsTo(Institution::class);
  }

  public function programme()
  {
      return $this->belongsTo(Programme::class);
  }

  public function departments()
  {
      return $this->hasMany(Department::class);
  }

  public function staff()
  {
      return $this->hasMany(Staff::class);
  }
}
