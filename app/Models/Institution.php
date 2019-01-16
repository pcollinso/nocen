<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
  protected $table = 'sup_institution';

  public function institution_type()
  {
      return $this->belongsTo(InstitutionType::class);
  }
}
