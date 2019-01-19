<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
  protected $table = 'sch_field';

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

  public function isDuplicate()
  {
      $duplicates = $this
        ->where('institution_id', $this->institution_id)
        ->where('field_name', $this->field_name)
        ->where('field_code', $this->field_code)
        ->where('field_abbrv', $this->field_abbrv)
        ->get();

      $num = count($duplicates);
      if (! $num) return false;
      if ($num > 1) return true;
      return $this->id && $duplicates[0]->id != $this->id;
  }
}
