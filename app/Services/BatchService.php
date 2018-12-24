<?php

namespace App\Services;
use App\Models\Batch;

class BatchService
{
  public function getAll()
  {
    return Batch::all()->all();
  }

  public function getById($id)
  {
    return Batch::find($id);
  }

  public function getByYear($year)
  {
    return Batch::where('batch_year', $year)->first();
  }

  public function create($attrs)
  {
    $existingBatch = $this->getByYear($attrs['batch_year']);
    if ($existingBatch) return $existingBatch;
    Batch::unguard();
    $batch = Batch::create($attrs);
    Batch::reguard();
    return $batch;
  }

}
