<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CoursePrerequisite extends Model
{
  protected $table = 'sch_course_prerequisite';

  public function institution()
  {
      return $this->belongsTo(Institution::class);
  }

  public function course()
  {
      return $this->belongsTo(Course::class);
  }

  public function isDuplicate()
  {
      $duplicates = $this
        ->where('institution_id', $this->institution_id)
        ->where('course_id', $this->course_id)
        ->where('require_course_id', $this->require_course_id)
        ->get();

      $num = count($duplicates);
      if (! $num) return false;
      if ($num > 1) return true;
      return $this->id && $duplicates[0]->id != $this->id;
  }
}
