<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class StudentOlevelResult extends Model
{
    protected $table = 'sch_student_qualf';
    protected $guarded = [];

    public function student()
    {
      return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function examType()
    {
      return $this->belongsTo(OlevelQualification::class, 'olevel_id', 'id');
    }
}
