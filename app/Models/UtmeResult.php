<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UtmeResult extends Model
{
    protected $table = 'sch_application_utme';
    protected $guarded = [];

    public function applicant()
    {
      return $this->belongsTo(Applicant::class, 'application_id', 'id');
    }
}
