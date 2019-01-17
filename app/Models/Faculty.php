<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
  protected $table = 'sch_faculty';

  public function staff()
  {
      return $this->hasMany(Staff::class);
  }
}
