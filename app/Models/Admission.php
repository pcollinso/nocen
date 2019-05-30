<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
  protected $table = 'sch_application_admission';
  protected $guarded = [];

  public function institution()
  {
      return $this->belongsTo(Institution::class);
  }

  public function application()
  {
      return $this->belongsTo(Applicant::class);
  }
}
