<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
  protected $table = 'sch_department';

  public function institution()
  {
      return $this->belongsTo(Institution::class);
  }

  public function programme()
  {
      return $this->belongsTo(Programme::class);
  }

  public function faculty()
  {
      return $this->belongsTo(Faculty::class);
  }

  public function course_advisers()
  {
      return $this->hasMany(CourseAdviser::class);
  }

  public function staff()
  {
      return $this->hasMany(Staff::class);
  }

  public function isDuplicate()
  {
      $duplicates = $this
        ->where('institution_id', $this->institution_id)
        ->where('department_name', $this->department_name)
        ->where('department_code', $this->department_code)
        ->where('department_abbrv', $this->department_abbrv)
        ->get();

      $num = count($duplicates);
      if (! $num) return false;
      if ($num > 1) return true;
      return $this->id && $duplicates[0]->id != $this->id;
  }
}
