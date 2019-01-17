<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CourseAdviser extends Model
{
    protected $table = 'sch_course_advicer';

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function isDuplicate()
    {
        $duplicates = $this
          ->where('institution_id', $this->institution_id)
          ->where('department_id', $this->department_id)
          ->where('staff_id', $this->staff_id)
          ->where('level_id', $this->level_id)
          ->get();

        $num = count($duplicates);
        if (! $num) return false;
        if ($num > 1) return true;
        return $this->id && $duplicates[0]->id != $this->id;
    }
}
