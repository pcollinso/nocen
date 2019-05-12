<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Town;

class OptionController extends Controller
{

  public function towns($stateId)
  {
    return response()->json([
      'towns' => Town::where('state_id', $stateId)->get()
    ]);
  }
}
