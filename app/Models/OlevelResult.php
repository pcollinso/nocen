<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OlevelResult extends Model
{
    protected $table = 'sch_application_qualf';
    protected $guarded = [];

    public function applicant()
    {
      return $this->belongsTo(Applicant::class, 'application_id', 'id');
    }

    public function examType()
    {
      return $this->belongsTo(OlevelQualification::class, 'olevel_id', 'id');
    }
}
