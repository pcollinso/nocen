<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Relationship;
use App\Models\Town;
use App\Models\OlevelGrade;
use App\Models\Subject;

class OptionController extends Controller
{

  public function towns($stateId)
  {
    return response()->json([
      'towns' => Town::where('state_id', $stateId)->get()
    ]);
  }

  public function relationships()
  {
    return response()->json([ 'data' => Relationship::all() ]);
  }

  public function subjects()
  {
    return response()->json([ 'data' => Subject::all() ]);
  }

  public function olevelGrades()
  {
    return response()->json([ 'data' => OlevelGrade::all() ]);
  }
}
