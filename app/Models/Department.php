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
}
