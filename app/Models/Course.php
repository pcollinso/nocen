<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
  protected $table = 'sch_course';

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

  public function department()
  {
      return $this->belongsTo(Department::class);
  }

  public function course_coordinators()
  {
      return $this->hasMany(CourseCoordinator::class);
  }

  public function isDuplicate()
  {
      $duplicates = $this
        ->where('institution_id', $this->institution_id)
        ->where('programme_id', $this->programme_id)
        ->where('faculty_id', $this->faculty_id)
        ->where('department_id', $this->department_id)
        ->where('course_name', $this->course_name)
        ->where('course_code', $this->course_code)
        ->get();

      $num = count($duplicates);
      if (! $num) return false;
      if ($num > 1) return true;
      return $this->id && $duplicates[0]->id != $this->id;
  }
}
