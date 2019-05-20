<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class NextOfKin extends Model
{
  protected $table = 'sch_application_nof';
  protected $guarded = [];

  public function applicant()
  {
    return $this->belongsTo(Applicant::class, 'application_id', 'id');
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
