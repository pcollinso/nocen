<?php

namespace App\Models;
use App\Traits\InsertOnDuplicateKey;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  use InsertOnDuplicateKey;
  protected $table = 'sch_payment';
}
