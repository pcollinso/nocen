<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class StudentNextOfKin extends Model
{
  protected $table = 'sch_student_nof';
  protected $guarded = [];

  public function student()
  {
    return $this->belongsTo(Student::class, 'student_id', 'id');
  }

  public function relationship()
  {
    return $this->belongsTo(Relationship::class, 'relationship_id', 'id');
  }

  public function gender()
  {
    return $this->belongsTo(Gender::class, 'gender_id', 'id');
  }
}
