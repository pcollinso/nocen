<?php

namespace App\Services;
use App\Models\Batch;

class BatchService
{
  public function getBatches()
  {
    return Batch::all()->all();
  }

  public function getBatchById($id)
  {
    return Batch::find($id);
  }

  public function getBatchByYear($year)
  {
    return Batch::where('batch_year', $year)->first();
  }

  public function createBatch($attrs)
  {
    $existingBatch = $this->getBatchByYear($attrs['batch_year']);
    if ($existingBatch) return $existingBatch;
    Batch::unguard();
    $batch = Batch::create($attrs);
    Batch::reguard();
    return $batch;
  }

}
