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

  public function isDuplicate()
  {
      $duplicates = $this
        ->where('institution_id', $this->institution_id)
        ->where('faculty_name', $this->faculty_name)
        ->where('faculty_code', $this->faculty_code)
        ->where('faculty_abbrv', $this->faculty_abbrv)
        ->get();

      $num = count($duplicates);
      if (! $num) return false;
      if ($num > 1) return true;
      return $this->id && $duplicates[0]->id != $this->id;
  }
}
